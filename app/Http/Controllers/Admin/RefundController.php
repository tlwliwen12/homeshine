<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\FinanceTransaction;


class RefundController extends Controller
{
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
}
