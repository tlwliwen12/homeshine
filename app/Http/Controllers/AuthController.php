<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PasswordResetNotification;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate(
            $this->registerValidation(),
            $this->registerMessages()
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,

            'approval_status' =>
                $request->role == 'cleaner'
                ? 'pending'
                : 'approved'
        ]);

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return redirect('/email/verify')
        ->with('verify', 'Please verify your email before continuing.');
    }

    public function showLogin(){
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            return back()->withErrors([
                'email' => 'Invalid email or password.'
            ]);
        }

        if (Auth::user()->status == 'Suspended') {

            Auth::logout();

            return back()->with(
                'error',
                'Your account has been suspended.'
            );
        }

        $request->session()->regenerate();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // CHECK EMAIL VERIFICATION HERE
        if (! $user->hasVerifiedEmail()) {

            Auth::logout();

            return back()->withErrors([
                'email' => 'Please verify your email first.'
            ]);
        }

        // CHECK CLEANER APPROVAL HERE
        if (
            $user->role === 'cleaner' &&
            $user->approval_status !== 'approved'
        ) {

            Auth::logout();

            return back()->withErrors([
                'email' => 'Your cleaner account is pending approval.'
            ]);
        }

        return $this->redirectByRole();
    }

    public function logout(Request $request)
    {
        Auth::logout(); // log out user

        $request->session()->invalidate(); // destroy session
        $request->session()->regenerateToken(); // prevent CSRF issues
        return redirect('/'); // go back to homepage
    }

    private function registerValidation()
    {
        return [
            'name' => 'required|max:255',

            'email' => 'required|email|unique:users',

            'password' => [
                'required',
                'min:8',
                'max:64',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[\W_]/',
            ],

            'role' => 'required|in:customer,cleaner'
        ];
    }

    private function registerMessages()
    {
        return [
            'name.required' => 'Name is required.',

            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'This email is already registered.',

            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password cannot exceed 10 characters.',
            'password.regex' => 'Password must include uppercase, lowercase, number, and symbol.',

            'role.required' => 'Please select a role.'
        ];
    }

    private function redirectByRole()
    {
        if (Auth::user()->role == 'customer') {
            return redirect('/customer/dashboard');
        }

        if (Auth::user()->role == 'cleaner') {
            return redirect('/cleaner/dashboard');
        }

        return redirect('/admin/dashboard');
    }

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where(
            'email',
            $request->email
        )->first();

        if (!$user) {

            return back()->with(
                'error',
                'Email not found.'
            );
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')
            ->updateOrInsert(
                ['email' => $user->email],
                [
                    'token' => $token,
                    'created_at' => now()
                ]
            );

        $user->notify(
            new PasswordResetNotification($token)
        );

        return back()->with(
            'success',
            'Password reset email sent.'
        );
    }

    public function showResetPassword($token)
    {
        return view(
            'auth.reset-password',
            compact('token')
        );
    }

    public function resetPassword(Request $request)
    {
        $request->validate([

            'token' => 'required',

            'password' => 'required|min:8|confirmed'

        ]);

        $reset = DB::table('password_reset_tokens')
            ->where(
                'token',
                $request->token
            )
            ->first();

        if (!$reset) {

            return back()->with(
                'error',
                'Invalid token.'
            );
        }

        User::where(
            'email',
            $reset->email
        )->update([

            'password' => Hash::make(
                $request->password
            )

        ]);

        DB::table('password_reset_tokens')
            ->where(
                'email',
                $reset->email
            )
            ->delete();

        return redirect('/login')
            ->with(
                'success',
                'Password reset successfully.'
            );
    }
}

