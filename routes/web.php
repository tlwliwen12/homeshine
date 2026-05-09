<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Models\Service;

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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/book-service/{id}', [BookingController::class, 'create']);

    Route::post('/book-service/{id}', [BookingController::class, 'store']);

    Route::get('/customer/bookings', [BookingController::class, 'index']);
});

Route::get('/customer/services', function (Request $request) {

    $query = Service::query();

    // filter category
    if ($request->category) {
        $query->where('category', $request->category);
    }

    $services = $query->get();

    return view('customer.services', compact('services'));

})->middleware(['auth', 'verified']);

Route::get('/services/{id}', [ServiceController::class, 'show'])
    ->middleware(['auth', 'verified']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
