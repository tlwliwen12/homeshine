<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\User;
use App\Notifications\RefundApprovedNotification;
use Illuminate\Support\Facades\Notification;

class RefundService
{
    public function approve(Booking $booking, $reference)
    {
        if ($booking->refund_status === 'Refunded') {
            return 'already_refunded';
        }

        $booking->update([
            'refund_status' => 'Refunded',
            'status' => 'Refunded',
            'refund_reference' => $reference,
            'refund_date' => now()
        ]);

        // notify customer
        $booking->user->notify(
            new RefundApprovedNotification($booking)
        );

        return 'success';
    }
}
