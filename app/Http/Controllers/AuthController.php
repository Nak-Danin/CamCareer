<?php

namespace App\Http\Controllers;

use App\Models\CareerSeeker;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'employer') {
                return redirect()->route('employer.dashboard');
            }
            return redirect()->route('welcome');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
            'role' => ['required', 'in:seeker,employer'],
            //only if role is seeker
            'first_name' => ['nullable', 'required_if:role,seeker', 'string', 'max:255'],
            'last_name' => ['nullable', 'required_if:role,seeker', 'string', 'max:255'],
            //only if role is employer
            'company_name' => ['nullable', 'required_if:role,employer', 'string', 'max:255']
        ]);
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        if ($validated['role'] === 'seeker') {
            CareerSeeker::create([
                'user_id' => $user->user_id,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name']
            ]);
        } elseif ($validated['role'] === 'employer') {
            Company::create([
                'user_id' => $user->user_id,
                'company_name' => $validated['company_name']
            ]);
        }
        Auth::login($user);
        if ($user->role === 'employer') {
            return redirect()->route('employer.dashboard');
        }
        return redirect()->route('welcome');
    }
}
