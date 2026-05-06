<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:customer,cleaner'
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'role.required' => 'Please select a role.'
            ]);

        // Save to database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        if ($user->role == 'customer') {
            return redirect('/customer/dashboard');
        } elseif ($user->role == 'cleaner') {
            return redirect('/cleaner/dashboard');
        }

        return redirect('/');
    }

    public function showLogin()
{
    return view('login');
}

public function login(Request $request)
{
    // Validate
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Attempt login
    if (Auth::attempt($request->only('email', 'password'))) {

        $request->session()->regenerate();

        // Check role
        if (Auth::user()->role == 'customer') {
            return redirect('/customer/dashboard');
        } elseif (Auth::user()->role == 'cleaner') {
            return redirect('/cleaner/dashboard');
        }

        return redirect('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Invalid email or password.',
    ]);
}
}
