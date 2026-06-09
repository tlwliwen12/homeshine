<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\FinanceTransaction;
use App\Services\ToyyibPayService;
use Illuminate\Support\Facades\Auth;

class RefundController extends Controller
{
    protected $toyyib;

    public function __construct(ToyyibPayService $toyyib)
    {
        $this->toyyib = $toyyib;
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'refund_status' => 'Completed',
            'status' => 'Cancelled'
        ]);

        FinanceTransaction::create([
            'booking_id' => $booking->id,
            'type' => 'Refund',
            'amount' => $booking->service->price,
            'status' => 'Completed'
        ]);

        return back()->with(
            'success',
            'Refund completed successfully.'
        );
    }

    public function index()
    {
        $refunds = Booking::whereNotNull('refund_status')->latest()->get();

        return view('admin.refunds', compact('refunds'));
    }

    public function refundPage($id)
    {
        $booking = Booking::findOrFail($id);

        return view(
            'admin.refund-payment',
            compact('booking')
        );
    }

    public function payRefund($id)
    {
        $booking = Booking::findOrFail($id);

        $billCode = $this->toyyib->createBill([

            'userSecretKey' => env('TOYYIBPAY_SECRET_KEY'),
            'categoryCode' => env('TOYYIBPAY_CATEGORY_CODE'),

            'billName' => 'HomeShine Refund',

            'billDescription' =>
                'Refund Booking #' . $booking->id,

            'billPriceSetting' => 1,
            'billPayorInfo' => 1,

            'billAmount' =>
                $booking->service->price * 100,

            'billReturnUrl' =>
                url('/admin/refunds/' .
                    $booking->id .
                    '/success'),

            'billCallbackUrl' =>
                url('/refund/callback'),

            'billExternalReferenceNo' =>
                'REFUND-' . $booking->id,

            'billTo' => 'HomeShine Admin',

            'billEmail' => Auth::user()->email,

            'billPhone' => '0123456789',

            'billPaymentChannel' => 0,
        ]);

        $booking->update([
            'refund_bill_code' => $billCode
        ]);

        return redirect(
            env('TOYYIBPAY_URL') . '/' . $billCode
        );
    }

    public function refundSuccess($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'refund_status' => 'Refunded',
            'status' => 'Cancelled'
        ]);

        FinanceTransaction::create([
            'booking_id' => $booking->id,
            'type' => 'Refund',
            'amount' => $booking->service->price,
            'status' => 'Completed'
        ]);

        return redirect('/admin/bookings')
            ->with(
                'success',
                'Refund completed successfully.'
            );
    }
}
