<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Services\ToyyibPayService;
use App\Services\PaymentService;
use App\Models\FinanceTransaction;

class PaymentController extends Controller
{
    protected $toyyib;
    protected $payment;

    public function __construct(
        ToyyibPayService $toyyib,
        PaymentService $payment
    ) {
        $this->toyyib = $toyyib;
        $this->payment = $payment;
    }

    /*
    |-----------------------------------
    | CREATE PAYMENT
    |-----------------------------------
    */
    public function pay($id)
    {
        $booking = Booking::findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $billCode = $this->toyyib->createBill([
            'userSecretKey' => env('TOYYIBPAY_SECRET_KEY'),
            'categoryCode' => env('TOYYIBPAY_CATEGORY_CODE'),
            'billName' => 'HomeShine Booking',
            'billDescription' => $booking->service->name,
            'billPriceSetting' => 1,
            'billPayorInfo' => 1,
            'billAmount' => $booking->service->price * 100,
            'billReturnUrl' => url('/payment/success/' . $booking->id),
            'billCallbackUrl' => url('/payment/callback'),
            'billExternalReferenceNo' => 'BOOKING-' . $booking->id,
            'billTo' => Auth::user()->name,
            'billEmail' => Auth::user()->email,
            'billPhone' => Auth::user()->phone ?? '0123456789',
            'billPaymentChannel' => 0,
        ]);

        $booking->update([
            'bill_code' => $billCode
        ]);

        return redirect(env('TOYYIBPAY_URL') . '/' . $billCode);
    }

    /*
    |-----------------------------------
    | PAYMENT SUCCESS (SAFE HANDLING)
    |-----------------------------------
    */
    public function success($id)
    {
        $booking = Booking::findOrFail($id);

        if (!$this->payment->isValidPayment($booking)) {
            return redirect('/customer/bookings')
                ->with('error', 'Invalid payment reference.');
        }

        if ($booking->payment_status === 'Paid') {
            return redirect('/customer/bookings')
                ->with(
                    'info',
                    'This booking has already been paid.'
                );
        }

        $this->payment->handleCustomerPayment($booking);

        return redirect('/customer/bookings')
            ->with('success', 'Payment completed successfully!');
    }

    /*
    |-----------------------------------
    | PAYMENT HISTORY
    |-----------------------------------
    */
    public function index()
    {
        $payments = Booking::where('user_id', Auth::id())
            ->where('payment_status', 'Paid')
            ->latest()
            ->get();

        $transactions = FinanceTransaction::whereHas('booking', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->latest()
        ->get();

        return view('customer.payments', compact(
            'payments',
            'transactions'
        ));
    }
}
