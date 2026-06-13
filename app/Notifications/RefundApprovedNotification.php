<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RefundApprovedNotification extends Notification
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

    public function toMail($notifiable): \Illuminate\Notifications\Messages\MailMessage
{
    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->markdown('mail.notification', [
            'title' => '💸 Refund Approved',
            'name' => $notifiable->name,
            'message' => 'Your refund request has been approved successfully.',
            'details' => [
                'Booking ID' => $this->booking->id,
                'Service' => $this->booking->service->name,
                'Refund Status' => 'Processed',
            ],
            'url' => url('/customer/bookings')
        ]);
}

    public function toArray($notifiable): array
{
    return [
        'title' => 'Refund Approved',
        'message' => 'Refund approved for booking #' . $this->booking->id,
        'booking_id' => $this->booking->id,
        'status' => 'Refunded',
    ];
}
}
