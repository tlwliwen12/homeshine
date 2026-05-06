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
            'password' => [
                'required',
                'min:8',
                'max:10',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[\W_]/',
            ],
            'role' => 'required|in:customer,cleaner'
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password cannot exceed 10 characters.',
            'password.regex' => 'Password must include uppercase, lowercase, number, and symbol.',
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
            return redirect('/customer/dashboard')
            ->with('verify', 'Please verify your email before continuing.');
        }

        return redirect('/cleaner/dashboard')
        ->with('verify', 'Please verify your email before continuing.');
    }

    public function showLogin(){
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
                }

            return redirect('/cleaner/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // log out user

        $request->session()->invalidate(); // destroy session
        $request->session()->regenerateToken(); // prevent CSRF issues
        return redirect('/'); // go back to homepage
    }
}
