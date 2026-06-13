<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CleanerPayoutNotification extends Notification
{
    use Queueable;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toArray($notifiable)
{
    return [
        'title' => 'Payout Completed',
        'message' => 'Earnings for Booking #' . $this->booking->id . ' have been paid.',
        'booking_id' => $this->booking->id,
        'status' => 'Paid',
    ];
}

    public function toMail($notifiable)
{
    $booking = $this->booking;

    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->markdown('mail.notification', [
            'title' => '💰 Payout Completed',
            'name' => $notifiable->name,
            'message' => 'Your earnings for a completed cleaning job have been processed successfully.',
            'details' => [
                'Booking ID' => $booking->id,
                'Service' => $booking->service->name,
                'Amount Status' => 'Paid',
            ],
            'url' => url('/cleaner/transactions')
        ]);
}
}
