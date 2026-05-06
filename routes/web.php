<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home');
});

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/email/verify', function () {
    return "Please check your email to verify your account.";
})->name('verification.notice');

// Handle verification link
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return "Email verified successfully!";
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend verification email (optional)
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return "Verification email resent!";
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Login
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/customer/dashboard', function () {
    return "Customer Dashboard";
})->middleware('auth', 'verified');

Route::get('/cleaner/dashboard', function () {
    return "Cleaner Dashboard";
})->middleware('auth', 'verified');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
