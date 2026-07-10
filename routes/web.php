<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\EmployerCareerController;
use App\Http\Controllers\InterviewController;
use App\Models\Career;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->get('/', function () {
    $user = Auth::user();
    return view('welcome', compact('user'));
})->name('welcome')->middleware('no.employers');
Route::get('/test', function () {
    $companies = Career::companyCareers()->get();
    dd($companies);
});
Route::middleware('auth')->controller(CareerController::class)->group(function () {
    Route::get('/careers', 'index')->name('careers');
    Route::get('/careers/create', 'create')->name('careers.create')->middleware(['can:create, App\Models\Career']);
    Route::get('/careers/{career}', 'show')->name('careers.show');
    Route::get('/careers/edit/{career}', 'edit')->name('careers.edit')->middleware(['can:update, App\Models\Career']);
    Route::post('/careers', 'store')->name('careers.store');
    Route::patch('/careers/{career}', 'update')->name('careers.update');
    Route::patch('/careers/delete/{career}', 'destroy')->name('careers.destroy')->middleware(['can:update, App\Models\Career']);
});

Route::get('/register', [AuthController::class, 'create'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->controller(EmployerCareerController::class)->group(function () {
    Route::get('/employer/dashboard', 'index')->name('employer.dashboard');
    Route::get('/employer/jobs', 'jobs')->name('employer.jobs');
    Route::get('/employer/jobs/{career}', 'viewJob')->name('employer.viewJob');
    Route::get('/employer/candidates', 'candidates')->name('employer.candidates');
    Route::get('/employer/applications/{career}', 'jobApplications')->name('employer.candidates.show');
    Route::patch('/employer/application/{application}/{status}', 'updateApplicationStatus')->name('employer.application.update_status')->whereIn('status', ['shortlisted', 'interview', 'offered', 'rejected']);
    Route::patch('/employer/application/{application}/revoke_offer', 'revokeOffer')->name('employer.application.revoke_offer');
});

Route::middleware('auth')->controller(InterviewController::class)->group(function () {
    Route::get('/employer/interviews', 'index')->name('employer.interviews');
});

Route::get('/test', [InterviewController::class, 'index']);
