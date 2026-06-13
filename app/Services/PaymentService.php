<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\FinanceTransaction;
use App\Models\User;
use App\Notifications\PaymentCompletedNotification;
use App\Notifications\CleanerJobPaidNotification;

class PaymentService
{
    /*
    |---------------------------------------
    | PROCESS CUSTOMER PAYMENT SUCCESS
    |---------------------------------------
    */
    public function handleCustomerPayment(Booking $booking)
    {
        if ($booking->payment_status === 'Paid') {
            return false;
        }

        $booking->update([
            'payment_status' => 'Paid'
        ]);

        // finance record
        FinanceTransaction::create([
            'booking_id' => $booking->id,
            'type' => 'Customer Payment',
            'amount' => $booking->service->price,
            'status' => 'Completed'
        ]);

        /*
        |-----------------------------------
        | NOTIFY CLEANER
        |-----------------------------------
        */
        if ($booking->cleaner_id) {

            $booking->cleaner->notify(
                new CleanerJobPaidNotification($booking)
            );
        }

        // notify admin + cleaner
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new PaymentCompletedNotification($booking)
            );
        }

        return true;
    }

    /*
    |---------------------------------------
    | VALIDATE PAYMENT (BASIC SAFETY CHECK)
    |---------------------------------------
    */
    public function isValidPayment(Booking $booking)
    {
        if (empty($booking->bill_code)) {
            return false;
        }

        if ($booking->payment_status === 'Paid') {
            return false;
        }

        return true;
    }
}
