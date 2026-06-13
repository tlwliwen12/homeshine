<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Booking;

class NewBookingNotification extends Notification
{
    use Queueable;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
{
    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->markdown('mail.notification', [
            'title' => '🆕 New Booking Received',
            'name' => 'Admin',
            'message' => 'A new booking has been created in the system.',
            'details' => [
                'Booking ID' => $this->booking->id,
                'Customer' => $this->booking->user->name,
                'Service' => $this->booking->service->name,
                'Date' => $this->booking->booking_date,
                'Time' => $this->booking->booking_time,
                'Status' => $this->booking->status,
            ],
            'url' => url('/admin/bookings')
        ]);
}
    public function toArray($notifiable)
{
    return [
        'title' => 'New Booking',
        'message' => 'New booking #' . $this->booking->id . ' created.',
        'booking_id' => $this->booking->id,
        'status' => $this->booking->status,
        'customer' => $this->booking->user->name,
    ];
}
}
