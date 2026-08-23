<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\EmployerCareerController;
use App\Http\Controllers\EmployerDashboardController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

// Registration
Route::get('/register', [AuthController::class, 'create'])
    ->name('register');

Route::post('/register', [AuthController::class, 'store'])
    ->name('auth.store');

// Login
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'authenticate'])
    ->name('auth.authenticate');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Seeker
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'no.employers'])->group(function () {

    // Seeker Home
    Route::get('/', [CareerController::class, 'index'])->name('seeker.home');

    // Careers
    Route::get('/careers', [CareerController::class, 'index'])->name('seeker.careers');
});


/*
|--------------------------------------------------------------------------
| Employer
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'employer'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Employer Dashboard & Jobs
    |--------------------------------------------------------------------------
    */
    Route::controller(CareerController::class)->group(function () {
        Route::get('/careers/create', 'create')
            ->name('careers.create')
            ->middleware('can:create, App\Models\Career');

        Route::post('/careers', 'store')
            ->name('careers.store');

        Route::get('/careers/{career}', 'show')
            ->name('careers.show');

        Route::get('/careers/edit/{career}', 'edit')
            ->name('careers.edit')
            ->middleware('can:update,career');

        Route::patch('/careers/{career}', 'update')
            ->name('careers.update');

        Route::patch('/careers/closeout/{career}', 'destroy')
            ->name('careers.closeout')
            ->middleware('can:update,career');

        Route::patch('/careers/reopen/{career}', 'reopen')
            ->name('careers.reopen')
            ->middleware('can:update,career');
    });

    Route::controller(EmployerCareerController::class)->group(function () {

        Route::get('/employer/dashboard', 'index')
            ->name('employer.dashboard');

        Route::get('/employer/jobs', 'jobs')
            ->name('employer.jobs');

        Route::get('/employer/jobs/{career}', 'viewJob')
            ->name('employer.viewJob')->middleware('can:view,career');

        Route::get('/employer/candidates', 'candidates')
            ->name('employer.candidates');

        Route::get('/employer/applications/{career}', 'jobApplications')
            ->name('employer.candidates.show')->middleware('can:view,career');


        // Application status
        Route::patch(
            '/employer/application/{application}/{status}',
            'updateApplicationStatus'
        )
            ->name('employer.application.update_status')
            ->whereIn('status', [
                'shortlisted',
                'interview',
                'offered'
            ]);

        Route::patch(
            '/employer/application/{application}/reject',
            'rejectApplication'
        )
            ->name('employer.application.reject');

        Route::patch(
            '/employer/application/{application}/revoke_offer',
            'revokeOffer'
        )
            ->name('employer.application.revoke_offer');
    });


    /*
    |--------------------------------------------------------------------------
    | Employer Interviews
    |--------------------------------------------------------------------------
    */

    Route::controller(InterviewController::class)->group(function () {

        Route::get('/employer/interviews', 'index')
            ->name('employer.interviews');

        Route::get('/employer/interview/create/{application}', 'create')
            ->name('employer.create_interview');

        Route::post('/employer/interviews/{application}', 'store')
            ->name('employer.interviews.store');

        Route::get('/employer/interviews/{interview}/edit', 'edit')
            ->name('employer.interview.edit');

        Route::patch('/employer/interviews/{interview}/update', 'update')
            ->name('employer.interview.update');

        Route::patch('/employer/interviews/{interview}/complete', 'completeInterview')
            ->name('employer.interview.complete');

        Route::patch('/employer/interviews/{interview}/cancel', 'cancelInterview')
            ->name('employer.interview.cancel');
    });


    /*
    |--------------------------------------------------------------------------
    | Employer Settings
    |--------------------------------------------------------------------------
    */

    Route::controller(SettingController::class)->group(function () {

        Route::get('/employer/settings', 'employerSettings')
            ->name('employer.settings');

        Route::get('/employer/settings/{company}/edit', 'employerSettingsEdit')
            ->name('employer.settings.edit');

        Route::patch('/employer/settings/{company}/update', 'employerSettingsUpdate')
            ->name('employer.settings.update');
    });


    /*
    |--------------------------------------------------------------------------
    | Employer Reports
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard/export-pdf', [
        EmployerDashboardController::class,
        'exportPdf'
    ])->name('dashboard.export-pdf');
});


/*
|--------------------------------------------------------------------------
| Fallback - Invalid Routes
|--------------------------------------------------------------------------
*/

Route::fallback(function () {

    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role === 'employer') {
        return redirect()->route('employer.dashboard');
    }

    if (Auth::user()->role === 'seeker') {
        return redirect()->route('seeker.home');
    }

    return redirect()->route('login');
});
