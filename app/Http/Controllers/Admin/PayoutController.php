<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\PayoutService;
use Illuminate\Http\Request;
use App\Services\ToyyibPayService;
use Illuminate\Support\Facades\Auth;
use App\Models\FinanceTransaction;
use App\Notifications\CleanerPayoutNotification;

class PayoutController extends Controller
{
    protected $toyyib;

    public function __construct(ToyyibPayService $toyyib)
    {
        $this->toyyib = $toyyib;
    }

    public function pay(Request $request, $id, PayoutService $service)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'payout_reference' => 'required|max:255'
        ]);

        $result = $service->pay($booking, $request->payout_reference);

        return back()->with(
            $result === 'success' ? 'success' : 'error',
            match ($result) {
                'success' => 'Payout successful',
                'not_completed' => 'Job not completed',
                'already_paid' => 'Already paid',
                'no_bank' => 'Cleaner bank missing',
                default => 'Error'
            }
        );
    }

    public function payPayout($id)
    {
        $booking = Booking::findOrFail($id);

        $billCode = $this->toyyib->createBill([

            'userSecretKey' => env('TOYYIBPAY_SECRET_KEY'),
            'categoryCode' => env('TOYYIBPAY_CATEGORY_CODE'),

            'billName' => 'Cleaner Payout',

            'billDescription' =>
                'Payout Booking #' . $booking->id,

            'billPriceSetting' => 1,
            'billPayorInfo' => 1,

            'billAmount' =>
                ($booking->service->price * 0.8) * 100,

            'billReturnUrl' =>
                url('/admin/payouts/' .
                    $booking->id .
                    '/success'),

            'billCallbackUrl' =>
                url('/payout/callback'),

            'billExternalReferenceNo' =>
                'PAYOUT-' . $booking->id,

            'billTo' =>
                $booking->cleaner->name,

            'billEmail' =>
                Auth::user()->email,

            'billPhone' =>
                '0123456789',

            'billPaymentChannel' => 0,
        ]);

        return redirect(
            env('TOYYIBPAY_URL') . '/' . $billCode
        );
    }

    public function payoutSuccess($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'payout_status' => 'Paid'
        ]);

        FinanceTransaction::create([
            'booking_id' => $booking->id,
            'type' => 'Cleaner Payout',
            'amount' => $booking->service->price * 0.8,
            'status' => 'Completed'
        ]);

        $booking->user->notify(
            new CleanerPayoutNotification($booking)
        );

        return redirect('/admin/bookings')
            ->with(
                'success',
                'Cleaner payout completed.'
            );
    }
}
