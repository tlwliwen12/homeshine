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
use App\Models\User;
use App\Notifications\BookingApprovedNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BookingCancelledNotification;
use App\Notifications\RefundApprovedNotification;
use App\Notifications\BookingRescheduledNotification;
use App\Notifications\PaymentCompletedNotification;
use App\Notifications\CleanerApprovedNotification;
use App\Notifications\CleanerRejectedNotification;
use App\Notifications\JobStatusUpdatedNotification;
use App\Models\Review;

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

        return redirect('/customer/dashboard')
            ->with('success', 'Email verified successfully!');
    }

    $user = $request->user();

    if (
        $user->role == 'cleaner' &&
        $user->approval_status != 'approved'
    ) {

        Auth::logout();

        return redirect('/login')->with(
            'success',
            'Email verified successfully. Your cleaner account is waiting for admin approval.'
        );
    }

    return redirect('/cleaner/dashboard')
        ->with('success', 'Email verified successfully!');

})->middleware(['auth', 'signed'])
  ->name('verification.verify');


// Resend verification email
Route::post('/email/verification-notification',
function (Request $request) {

    $request->user()
            ->sendEmailVerificationNotification();

    return back()->with(
        'message',
        'Verification email resent successfully!'
    );

})->middleware(['auth', 'throttle:6,1'])
  ->name('verification.send');

Route::get('/admin/cleaners', function () {

    if (Auth::user()->role != 'admin') {
        abort(403);
    }

    $cleaners = User::where(
        'role',
        'cleaner'
    )->get();

    return view(
        'admin.cleaners',
        compact('cleaners')
    );

})->middleware('auth');

Route::post('/admin/cleaners/{id}/approve', function ($id) {

    $cleaner = User::findOrFail($id);

    $cleaner->update([
        'approval_status' => 'approved'
    ]);

    $cleaner->notify(
        new CleanerApprovedNotification()
    );

    return back()->with(
        'success',
        'Cleaner approved successfully.'
    );

})->middleware('auth');

Route::post('/admin/cleaners/{id}/reject', function ($id) {

    $cleaner = User::findOrFail($id);

    $cleaner->update([
        'approval_status' => 'rejected'
    ]);

    $cleaner->notify(
        new CleanerRejectedNotification()
    );

    return back()->with(
        'success',
        'Cleaner rejected successfully.'
    );

})->middleware('auth');

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/customer/dashboard', function () {

    return view('customer.dashboard');

})->middleware('auth', 'verified');


Route::get('/cleaner/dashboard', function () {

    return view('cleaner.dashboard');

})->middleware('auth', 'verified');

Route::post('/cleaner/jobs/{id}/status', function (Request $request, $id) {

    $booking = Booking::findOrFail($id);

    $request->validate([
        'status' => 'required|in:Approved,In Progress,Completed'
    ]);

    $booking->update([
        'status' => $request->status
    ]);

    // Notify customer
    $booking->user->notify(
        new JobStatusUpdatedNotification($booking)
    );

    return back()->with(
        'success',
        'Job status updated successfully.'
    );

})->middleware('auth');

Route::post('/cleaner/jobs/{id}/status', function (Request $request, $id) {

    $booking = Booking::findOrFail($id);

    // Prevent status update if unpaid
    if ($booking->payment_status != 'Paid') {

        return back()->with(
            'error',
            'Customer payment has not been completed.'
        );
    }

    $request->validate([
        'status' => 'required|in:Approved,In Progress,Completed'
    ]);

    $booking->update([
        'status' => $request->status
    ]);

    $booking->user->notify(
        new JobStatusUpdatedNotification($booking)
    );

    return back()->with(
        'success',
        'Job status updated successfully.'
    );

})->middleware('auth');

Route::get('/admin/dashboard', function () {

    if (Auth::user()->role != 'admin') {
        abort(403);
    }

    return view('admin.dashboard');

})->middleware('auth');


Route::middleware('auth')->group(function () {

    Route::get('/admin/services',
        [ServiceController::class, 'index']);

    Route::get('/admin/services/create',
        [ServiceController::class, 'create']);

    Route::post('/admin/services',
        [ServiceController::class, 'store']);

    Route::get('/admin/services/{id}/edit',
        [ServiceController::class, 'edit']);

    Route::post('/admin/services/{id}/update',
        [ServiceController::class, 'update']);

    Route::post('/admin/services/{id}/delete',
        [ServiceController::class, 'destroy']);
});


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/book-service/{id}',
        [BookingController::class, 'create']);

    Route::post('/book-service/{id}',
        [BookingController::class, 'store']);

    Route::get('/customer/bookings',
        [BookingController::class, 'index']);
});

Route::get('/customer/services',
function (Request $request) {

    $query = Service::query();

    // Search
    if ($request->search) {

        $query->where(function ($q) use ($request) {

            $q->where(
                'name',
                'like',
                '%' . $request->search . '%'
            )

            ->orWhere(
                'category',
                'like',
                '%' . $request->search . '%'
            )

            ->orWhere(
                'description',
                'like',
                '%' . $request->search . '%'
            );

        });
    }

    // Category Filter
    if ($request->category) {

        $query->where(
            'category',
            $request->category
        );
    }

    $services = $query->get();

    return view(
        'customer.services',
        compact('services')
    );

})->middleware(['auth', 'verified']);


Route::get('/services/{id}',
    [ServiceController::class, 'show'])
    ->middleware(['auth', 'verified']);


Route::post('/customer/bookings/{id}/cancel',
function ($id) {

    $booking = Booking::findOrFail($id);

    // Security check
    if ($booking->user_id != Auth::id()) {
        abort(403);
    }

    // Prevent double cancel
    if ($booking->status == 'Cancelled') {

        return back()->with(
            'error',
            'Booking already cancelled.'
        );
    }

    // Cancel booking
    $booking->status = 'Cancelled';

    // If already paid -> refund pending
    if ($booking->payment_status == 'Paid') {

        $booking->refund_status = 'Pending';

    }

    $booking->save();

    // Notify admin + cleaner
    $users = User::whereIn(
        'role',
        ['admin', 'cleaner']
    )->get();

    foreach ($users as $user) {

        $user->notify(
            new BookingCancelledNotification($booking)
        );

    }

    // Success message
    if ($booking->payment_status == 'Paid') {

        return back()->with(
            'success',
            'Booking cancelled successfully. Refund request submitted.'
        );

    }

    return back()->with(
        'success',
        'Booking cancelled successfully.'
    );

})->middleware('auth');


Route::post('/customer/bookings/{id}/reschedule',
function (Request $request, $id) {

    $booking = Booking::findOrFail($id);

    // Security check
    if ($booking->user_id != Auth::id()) {
        abort(403);
    }

    // Validate
    $request->validate([

        'booking_date' =>
            'required|date|after_or_equal:today',

        'booking_time' =>
            'required'

    ]);

    // Update booking
    $booking->update([

        'booking_date' =>
            $request->booking_date,

        'booking_time' =>
            $request->booking_time,

        'status' =>
            'Pending'

    ]);

    // Notify admin + cleaner
    $users = User::whereIn(
        'role',
        ['admin', 'cleaner']
    )->get();

    foreach ($users as $user) {

        $user->notify(
            new BookingRescheduledNotification($booking)
        );

    }

    return back()->with(
        'success',
        'Booking rescheduled successfully!'
    );

})->middleware('auth');

// Show forgot password form
Route::get('/forgot-password', function () {

    return view('auth.forgot-password');

})->middleware('guest')
  ->name('password.request');


// Send reset link
Route::post('/forgot-password',
function (Request $request) {

    $request->validate([
        'email' => 'required|email'
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT

        ? back()->with([
            'status' => __($status)
        ])

        : back()->withErrors([
            'email' => __($status)
        ]);

})->middleware('guest')
  ->name('password.email');


// Show reset password form
Route::get('/reset-password/{token}',
function (string $token) {

    return view(
        'auth.reset-password',
        ['token' => $token]
    );

})->middleware('guest')
  ->name('password.reset');


// Handle reset password
Route::post('/reset-password',
function (Request $request) {

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

        $request->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        ),

        function ($user, $password) {

            $user->forceFill([

                'password' => Hash::make($password)

            ])->setRememberToken(
                Str::random(60)
            );

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET

        ? redirect('/login')->with(
            'success',
            'Password reset successfully!'
        )

        : back()->withErrors([
            'email' => [__($status)]
        ]);

})->middleware('guest')
  ->name('password.update');

Route::get('/customer/payment/{id}',
function ($id) {

    $booking = Booking::findOrFail($id);

    return view(
        'customer.payment',
        compact('booking')
    );

})->middleware('auth');


Route::get('/customer/payments',
function () {

    $payments = Booking::where(
            'user_id',
            Auth::id()
        )

        ->whereNotNull('bill_code')
        ->latest()
        ->get();

    return view(
        'customer.payments',
        compact('payments')
    );

})->middleware('auth');


Route::get('/payment/{id}',
function ($id) {

    $booking = Booking::findOrFail($id);

    $user = Auth::user();

    $response = Http::asForm()

        ->timeout(60)

        ->retry(3, 2000)

        ->post(

            env('TOYYIBPAY_URL')
            . '/index.php/api/createBill',

            [

                'userSecretKey' =>
                    env('TOYYIBPAY_SECRET_KEY'),

                'categoryCode' =>
                    env('TOYYIBPAY_CATEGORY_CODE'),

                'billName' =>
                    'HomeShine Booking',

                'billDescription' =>
                    $booking->service->name,

                'billPriceSetting' => 1,

                'billPayorInfo' => 1,

                // amount in cent
                'billAmount' =>
                    $booking->service->price * 100,

                'billReturnUrl' =>
                    url('/payment-success/' . $booking->id),

                'billCallbackUrl' =>
                    url('/payment-callback'),

                'billExternalReferenceNo' =>
                    'BOOKING-' . $booking->id,

                'billTo' =>
                    $user->name,

                'billEmail' =>
                    $user->email,

                'billPhone' =>
                    '0123456789',

                'billPaymentChannel' => 0,
            ]
        );

    if (!$response->successful()) {

        return back()->with(
            'error',
            'Payment gateway error. Please try again later.'
        );
    }

    $result = $response->json();

    $billCode = $result[0]['BillCode'];

    $booking->update([

        'bill_code' => $billCode

    ]);

    return redirect(

        env('TOYYIBPAY_URL')
        . '/' . $billCode
    );

})->middleware('auth');


Route::get('/payment-success/{id}', function ($id) {

    $booking = Booking::findOrFail($id);

    if ($booking->payment_status !== 'Paid') {

        $booking->update([
            'payment_status' => 'Paid',
            'status' => 'Approved'
        ]);

        $users = User::whereIn('role', ['admin', 'cleaner'])->get();

        foreach ($users as $user) {
            $user->notify(
                new PaymentCompletedNotification($booking)
            );
        }
    }

    return redirect('/customer/bookings')
        ->with(
            'success',
            'Payment completed successfully!'
        );

})->middleware('auth');

Route::get('/cleaner/bookings', function () {

    $bookings = Booking::latest()->get();

    return view('cleaner.bookings', compact('bookings'));

})->middleware('auth');

Route::post('/cleaner/bookings/{id}/approve', function ($id) {

    $booking = Booking::findOrFail($id);

    $booking->status = 'Approved';

    // SAVE CLEANER
    $booking->cleaner_id = Auth::id();

    $booking->save();

    // reload relationship
    $booking->load('cleaner');

    // customer notification
    $booking->user->notify(
        new BookingApprovedNotification($booking)
    );

    return back()->with(
        'success',
        'Booking approved successfully.'
    );

})->middleware('auth');

Route::post('/cleaner/bookings/{id}/reject', function ($id) {

    $booking = Booking::findOrFail($id);

    $booking->update([
        'status' => 'Rejected'
    ]);

    return back()->with(
        'success',
        'Booking rejected successfully.'
    );

})->middleware('auth');

Route::get('/cleaner/jobs', function (Request $request) {

    $query = Booking::query();

    // Status filter
    if ($request->filter == 'upcoming') {

        $query->whereIn(
            'status',
            ['Approved', 'In Progress']
        );

    } elseif ($request->filter == 'completed') {

        $query->where(
            'status',
            'Completed'
        );

    }

    // Payment filter
    if ($request->payment == 'paid') {

        $query->where(
            'payment_status',
            'Paid'
        );

    } elseif ($request->payment == 'unpaid') {

        $query->where(
            'payment_status',
            'Unpaid'
        );

    }

    $bookings = $query
        ->orderBy('booking_date')
        ->orderBy('booking_time')
        ->get();

    return view(
        'cleaner.jobs',
        compact('bookings')
    );

})->middleware('auth');

Route::post('/admin/refunds/{id}/approve', function ($id) {

    $booking = Booking::findOrFail($id);

    // Update refund status
    $booking->update([

        'refund_status' => 'Refunded'

    ]);

    // Send notification + email to customer
    $booking->user->notify(

        new RefundApprovedNotification($booking)

    );

    return back()->with(

        'success',
        'Refund approved successfully.'

    );

})->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/customer/profile', function () {

        return view('customer.profile');

    });

    Route::post('/customer/profile/update',
    function (Request $request) {

        $request->validate([

            'name' => 'required|max:255',

            'email' => 'required|email|max:255',

            'phone' => 'nullable|max:20',

            'address' => 'nullable|max:500',

        ]);

        $user = User::find(Auth::id());

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;

        $user->save();

        return back()->with(
            'success',
            'Profile updated successfully!'
        );

    });

});

Route::post('/customer/review/{id}',
function (Request $request, $id) {

    $booking = Booking::findOrFail($id);

    // Security check
    if ($booking->user_id != Auth::id()) {
        abort(403);
    }

    // Only completed booking can review
    if ($booking->status != 'Completed') {

        return back()->with(
            'error',
            'You can only review completed services.'
        );
    }

    // Prevent duplicate review
    if (Review::where('booking_id', $booking->id)->exists()) {

        return back()->with(
            'error',
            'You already reviewed this service.'
        );
    }

    $request->validate([

        'rating' => 'required|integer|min:1|max:5',

        'review' => 'nullable|max:1000',

    ]);

    Review::create([

        'user_id' => Auth::id(),

        'service_id' => $booking->service_id,

        'booking_id' => $booking->id,

        'rating' => $request->rating,

        'review' => $request->review,

    ]);

    return back()->with(
        'success',
        'Review submitted successfully!'
    );

})->middleware('auth');

Route::middleware('auth')->group(function () {

    // Cleaner Profile Page
    Route::get('/cleaner/profile', function () {

        return view('cleaner.profile');

    });

    // Update Cleaner Profile
    Route::post('/cleaner/profile/update', function (Request $request) {

        $request->validate([

            'name' => 'required|max:255',

            'email' => 'required|email|max:255',

            'phone' => 'nullable|max:20',

            'gender' => 'nullable',

        ]);

        $user = User::find(Auth::id());

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;

        $user->save();

        return back()->with(
            'success',
            'Profile updated successfully!'
        );

    });

});

Route::post('/logout', function () {

    Auth::logout();

    return redirect('/');

})->name('logout');
