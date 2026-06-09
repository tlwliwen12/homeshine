<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\FinanceTransaction;
use App\Models\User;
use App\Notifications\CleanerPayoutNotification;

class PayoutService
{
    public function pay(Booking $booking, $reference)
    {
        if ($booking->status !== 'Completed') {
            return 'not_completed';
        }

        if ($booking->payout_status === 'Paid') {
            return 'already_paid';
        }

        if (!$booking->cleaner || !$booking->cleaner->bank_account_number) {
            return 'no_bank';
        }

        $booking->update([
            'payout_status' => 'Paid',
            'payout_reference' => $reference,
            'payout_date' => now()
        ]);

        FinanceTransaction::create([
            'booking_id' => $booking->id,
            'type' => 'Cleaner Payout',
            'amount' => $booking->cleaner_earning
                ?? $booking->service->price,
            'status' => 'Completed'
        ]);

        $booking->cleaner->notify(
            new CleanerPayoutNotification($booking)
        );

        return 'success';
    }
}
