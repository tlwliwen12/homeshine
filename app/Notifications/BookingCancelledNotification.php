<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingCancelledNotification extends Notification
{
    use Queueable;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    // Send via database + email
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    // Email notification
    public function toMail($notifiable)
{
    $booking = $this->booking;

    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->markdown('mail.notification', [
            'title' => '❌ Booking Cancelled',
            'name' => $notifiable->name,
            'message' => 'A booking has been cancelled by the customer.',
            'details' => [
                'Booking ID' => $booking->id,
                'Service' => $booking->service->name,
                'Customer' => $booking->user->name,
                'Date' => $booking->booking_date,
                'Time' => $booking->booking_time,
                'Payment Status' => $booking->payment_status,
                'Note' => $booking->payment_status == 'Paid'
                    ? 'Refund request is pending.'
                    : 'No payment was made.',
            ],
            'url' => url('/login')
        ]);
}

    // Database notification
    public function toArray($notifiable): array
{
    return [
        'title' => 'Booking Cancelled',
        'message' => 'Booking #' . $this->booking->id . ' cancelled by customer.',
        'booking_id' => $this->booking->id,
        'service' => $this->booking->service->name,
        'customer' => $this->booking->user->name,
        'status' => 'Cancelled',
    ];
}
}
