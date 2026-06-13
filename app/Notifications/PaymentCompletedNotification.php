<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentCompletedNotification extends Notification
{
    use Queueable;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): \Illuminate\Notifications\Messages\MailMessage
{
    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->markdown('mail.notification', [
            'title' => '💳 Payment Completed',
            'name' => $notifiable->name,
            'message' => 'Payment has been successfully completed for a booking.',
            'details' => [
                'Booking ID' => $this->booking->id,
                'Service' => $this->booking->service->name,
                'Customer' => $this->booking->user->name,
                'Amount Status' => 'Paid',
            ],
            'url' => url('/admin/bookings')
        ]);
}

    public function toArray($notifiable): array
{
    return [
        'title' => 'Payment Completed',
        'message' => 'Payment completed for booking #' . $this->booking->id,
        'booking_id' => $this->booking->id,
        'status' => 'Paid',
        'customer' => $this->booking->user->name,
    ];
}
}
