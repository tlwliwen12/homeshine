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
        return (new MailMessage)
            ->subject('New Booking Received')
            ->line('A new booking has been created.')
            ->line('Booking ID: #' . $this->booking->id)
            ->action(
                'View Booking',
                url('/admin/bookings')
            );
    }

    public function toArray($notifiable)
    {
        return [
            'message' =>
                'New booking #' . $this->booking->id,
            'booking_id' =>
                $this->booking->id
        ];
    }
}
