<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Models\Service;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\Booking;

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

    // Search keyword
    if ($request->search) {

        $query->where(function ($q) use ($request) {

            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('category', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');

        });
    }

    // Category filter
    if ($request->category) {
        $query->where('category', $request->category);
    }

    $services = $query->get();

    return view('customer.services', compact('services'));

})->middleware(['auth', 'verified']);

Route::get('/services/{id}', [ServiceController::class, 'show'])
    ->middleware(['auth', 'verified']);

// Show forgot password form
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::get('/customer/payment/{id}', function ($id) {

    $booking = Booking::findOrFail($id);

    return view('customer.payment', compact('booking'));

})->middleware('auth');

Route::get('/payment/{id}', function ($id) {

    $booking = Booking::findOrFail($id);

    $user = Auth::user();

    $response = Http::asForm()->post(
        env('TOYYIBPAY_URL').'/index.php/api/createBill',

        [

            'userSecretKey' => env('TOYYIBPAY_SECRET_KEY'),

            'categoryCode' => env('TOYYIBPAY_CATEGORY_CODE'),

            'billName' => 'HomeShine Booking',

            'billDescription' => $booking->service->name,

            'billPriceSetting' => 1,

            'billPayorInfo' => 1,

            // amount in cent
            'billAmount' => $booking->service->price * 100,

            'billReturnUrl' =>
                url('/payment-success/'.$booking->id),

            'billCallbackUrl' =>
                url('/payment-callback'),

            'billExternalReferenceNo' =>
                'BOOKING-'.$booking->id,

            'billTo' => $user->name,

            'billEmail' => $user->email,

            'billPhone' => '0123456789',

            'billPaymentChannel' => 0,

        ]
    );

    $result = $response->json();

    $billCode = $result[0]['BillCode'];

    $booking->update([
        'bill_code' => $billCode
    ]);

    return redirect(
        env('TOYYIBPAY_URL').'/'.$billCode
    );

})->middleware('auth');

Route::get('/payment-success/{id}', function ($id) {

    $booking = Booking::findOrFail($id);

    $booking->update([
        'payment_status' => 'Paid'
    ]);

    return redirect('/customer/bookings')
        ->with('success',
            'Payment completed successfully!'
        );

})->middleware('auth');


// Send reset link
Route::post('/forgot-password', function (Request $request) {

    $request->validate([
        'email' => 'required|email'
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);

})->middleware('guest')->name('password.email');


// Show reset password form
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');


// Handle reset password
Route::post('/reset-password', function (Request $request) {

    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => [
            'required',
            'confirmed',
            'min:8',
            'max:10',
            'regex:/[a-z]/',
            'regex:/[A-Z]/',
            'regex:/[0-9]/',
            'regex:/[\W_]/',
        ],
    ]);

    $status = Password::reset(

        $request->only('email', 'password', 'password_confirmation', 'token'),

        function ($user, $password) use ($request) {

            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect('/login')->with('success', 'Password reset successfully!')
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
