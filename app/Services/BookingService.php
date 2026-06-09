<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\User;
use App\Models\FinanceTransaction;
use Illuminate\Support\Facades\Notification;

use App\Notifications\BookingCancelledNotification;
use App\Notifications\BookingRescheduledNotification;

class BookingService
{
    /*
    |----------------------------------------------------
    | CANCEL BOOKING
    |----------------------------------------------------
    */
    public function cancel(Booking $booking)
    {
        if ($booking->status === 'Cancelled') {
            return 'already_cancelled';
        }

        $booking->status = 'Cancelled';

        if ($booking->payment_status === 'Paid') {
            $booking->refund_status = 'Pending';
        }

        $booking->save();

        // notify admin
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new BookingCancelledNotification($booking));

        // notify cleaner
        if ($booking->cleaner) {
            $booking->cleaner->notify(new BookingCancelledNotification($booking));
        }

        return 'success';
    }

    /*
    |----------------------------------------------------
    | RESCHEDULE BOOKING
    |----------------------------------------------------
    */
    public function reschedule(Booking $booking, $date, $time)
    {
        $booking->update([
            'booking_date' => $date,
            'booking_time' => $time,
            'status' => 'Pending'
        ]);

        return true;
    }

    /*
    |----------------------------------------------------
    | COMPLETE PAYMENT (FINANCE ENTRY)
    |----------------------------------------------------
    */
    public function recordPayment(Booking $booking)
    {
        FinanceTransaction::create([
            'booking_id' => $booking->id,
            'type' => 'Customer Payment',
            'amount' => $booking->service->price,
            'status' => 'Completed'
        ]);
    }
}
