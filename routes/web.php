<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Http\Controllers\ServiceController;

Route::get('/', function () {

    if (Auth::check()) {

        if (Auth::user()->role == 'customer') {
            return redirect('/customer/dashboard');
        }

        if (Auth::user()->role == 'cleaner') {
            return redirect('/cleaner/dashboard');
        }

        if (Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard');
        }
    }

    return view('home');
});

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/email/verify', function () {
    return view('verify-email');
})->middleware('auth')->name('verification.notice');

// Handle verification link
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    if ($request->user()->role == 'customer') {
        return redirect('/customer/dashboard')->with('success', 'Email verified successfully!');
    }

    return redirect('/cleaner/dashboard')->with('success', 'Email verified successfully!');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend verification email
Route::post('/email/verification-notification', function (Request $request) {

    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification email resent successfully!');

})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Login
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/customer/dashboard', function () {
    return view('customer.dashboard');
})->middleware('auth', 'verified');

Route::get('/cleaner/dashboard', function () {
    return view('cleaner.dashboard');
})->middleware('auth', 'verified');

Route::get('/admin/dashboard', function () {

    if (Auth::user()->role != 'admin') {
        abort(403);
    }

    return view('admin.dashboard');

})->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/admin/services', [ServiceController::class, 'index']);

    Route::get('/admin/services/create', [ServiceController::class, 'create']);

    Route::post('/admin/services', [ServiceController::class, 'store']);

    Route::get('/admin/services/{id}/edit', [ServiceController::class, 'edit']);

    Route::post('/admin/services/{id}/update', [ServiceController::class, 'update']);

    Route::post('/admin/services/{id}/delete', [ServiceController::class, 'destroy']);
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
