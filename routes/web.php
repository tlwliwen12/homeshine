<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Cleaner\DashboardController as CleanerDashboardController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

use App\Http\Controllers\Customer\BookingController as CustomerBookingController;
use App\Http\Controllers\Cleaner\JobController as CleanerJobController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;

use App\Http\Controllers\Customer\ServiceController as CustomerServiceController;
use App\Http\Controllers\Customer\PaymentController;
use App\Http\Controllers\Customer\ReviewController as CustomerReviewController;

use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Cleaner\ProfileController as CleanerProfileController;

use App\Http\Controllers\Cleaner\TransactionController as CleanerTransactionController;

use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\RefundController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\Admin\CleanerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CustomerManagementController;
use App\Http\Controllers\Admin\ReviewController;

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index']);

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/forgot-password',[AuthController::class, 'showForgotPassword']);
Route::post('/forgot-password',[AuthController::class, 'sendResetLink']);
Route::get('/reset-password/{token}',[AuthController::class, 'showResetPassword']);
Route::post('/reset-password',[AuthController::class, 'resetPassword']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| EMAIL VERIFICATION
|--------------------------------------------------------------------------
*/

Route::get('/email/verify', function () {
    return view('verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (
    EmailVerificationRequest $request
) {

    $request->fulfill();

    $user = $request->user();

    if ($user->role === 'cleaner') {

        $admins = \App\Models\User::where(
            'role',
            'admin'
        )->get();

        foreach ($admins as $admin) {

            $admin->notify(
                new \App\Notifications\CleanerRegistrationNotification($user)
            );
        }
    }

    return redirect('/login')
        ->with(
            'success',
            'Email verified successfully. Please wait for admin approval.'
        );

})->middleware(['auth', 'signed'])
  ->name('verification.verify');

Route::post('/email/verification-notification', function (
    Request $request
) {
    $request->user()
        ->sendEmailVerificationNotification();

    return back()->with(
        'success',
        'Verification email sent.'
    );
})->middleware(['auth', 'throttle:6,1'])
  ->name('verification.send');

/*
|--------------------------------------------------------------------------
| CUSTOMER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:customer'])->group(function () {

    Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index']);

    Route::get('/customer/services',[CustomerServiceController::class, 'index']
    )->name('customer.services');
    Route::get('/customer/services/{id}',[CustomerServiceController::class, 'show']
    )->name('customer.services.show');

    Route::get('/customer/book-service/{id}',[CustomerBookingController::class, 'create']
    )->name('booking.create');

    Route::post('/customer/book-service/{id}',[CustomerBookingController::class, 'store']
    )->name('booking.store');

    Route::get('/customer/bookings', [CustomerBookingController::class, 'index'])->name('customer.bookings');
    Route::post('/customer/bookings/{id}/cancel', [CustomerBookingController::class, 'cancel']);
    Route::post('/customer/bookings/{id}/reschedule', [CustomerBookingController::class, 'reschedule']);

    Route::get('/customer/payments',[PaymentController::class, 'index']);

    Route::get('/customer/payment/{id}', [PaymentController::class, 'pay']);
    Route::get('/payment/success/{id}', [PaymentController::class, 'success']);

    Route::post('/customer/review/{id}', [CustomerReviewController::class, 'store']);

    Route::get('/customer/profile', [CustomerProfileController::class, 'index']);
    Route::post('/customer/profile/update', [CustomerProfileController::class, 'update']);
    Route::post('/customer/update-password',[CustomerProfileController::class, 'updatePassword']);

    Route::post('/customer/notifications/read', function () {

    Auth::user()->unreadNotifications->markAsRead();

    return response()->json(['status' => 'success']);

})->name('customer.notifications.read');
});

/*
|--------------------------------------------------------------------------
| CLEANER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:cleaner'])->group(function () {

    Route::get('/cleaner/dashboard', [CleanerDashboardController::class, 'index']);

    Route::get('/cleaner/bookings',[CleanerJobController::class, 'bookingRequests']);
    Route::post('/cleaner/bookings/{id}/accept',[CleanerJobController::class, 'accept']);
    Route::post('/cleaner/bookings/{id}/reject',[CleanerJobController::class, 'reject']);

    Route::get('/cleaner/jobs', [CleanerJobController::class, 'index']);
    Route::post('/cleaner/jobs/{id}/status', [CleanerJobController::class, 'updateStatus']);
    Route::post('/cleaner/jobs/{id}/accept', [CleanerJobController::class, 'accept']);

    Route::get('/cleaner/profile', [CleanerProfileController::class, 'index']);
    Route::post('/cleaner/profile/update', [CleanerProfileController::class, 'update']);
    Route::post('/cleaner/update-password',[CleanerProfileController::class, 'updatePassword']);

    Route::get('/cleaner/transactions', [CleanerTransactionController::class, 'index']);

    Route::post('/cleaner/notifications/read',[App\Http\Controllers\Cleaner\NotificationController::class,
    'markRead'])->name('cleaner.notifications.read');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);

    Route::get('/admin/bookings', [AdminBookingController::class, 'index']);
    Route::get('/admin/bookings/{id}',[AdminBookingController::class, 'show']);

    Route::get('/admin/transactions', [FinanceController::class, 'index']);
    Route::get('/admin/transactions/export/pdf',[FinanceController::class, 'exportPdf']);

    Route::get('/admin/refunds/{id}/pay',[RefundController::class, 'refundPage']);
    Route::post('/admin/refunds/{id}/approve',[RefundController::class, 'approve']);
    Route::get('/admin/refunds/{id}/pay',[RefundController::class, 'payRefund']);
    Route::get('/admin/refunds/{id}/success',[RefundController::class, 'refundSuccess']);
    Route::get('/admin/refunds', [RefundController::class, 'index']);

    Route::get('/admin/payouts/{id}/pay',[PayoutController::class, 'payPayout']);
    Route::get('/admin/payouts/{id}/success',[PayoutController::class, 'payoutSuccess']);

    Route::get('/admin/cleaners', [CleanerController::class, 'index']);
    Route::post('/admin/cleaners/{id}/approve', [CleanerController::class, 'approve']);
    Route::post('/admin/cleaners/{id}/reject', [CleanerController::class, 'reject']);

    Route::get('/admin/services', [ServiceController::class, 'index']);
    Route::post('/admin/services', [ServiceController::class, 'store']);
    Route::get('/admin/services/create',[ServiceController::class, 'create']);
    Route::get('/admin/services/{id}/edit',[ServiceController::class, 'edit']);
    Route::post('/admin/services/{id}/update',[ServiceController::class, 'update']);
    Route::post('/admin/services/{id}/delete',[ServiceController::class, 'destroy']);

    Route::get('/admin/customers',[CustomerManagementController::class, 'index']);
    Route::post('/admin/customers/{id}/delete',[CustomerManagementController::class, 'destroy']);
    Route::get('/admin/customers/{id}',[CustomerManagementController::class, 'show']);
    Route::post('/admin/customers/{id}/suspend',[CustomerManagementController::class, 'suspend']);
    Route::post('/admin/customers/{id}/activate',[CustomerManagementController::class, 'activate']);
    Route::get('/admin/customer-statistics',[CustomerManagementController::class, 'statistics']);

    Route::get('/admin/reviews',[ReviewController::class, 'index']);

    Route::post('/admin/notifications/read',[App\Http\Controllers\Admin\NotificationController::class,
    'markRead'])->name('admin.notifications.read');
});
