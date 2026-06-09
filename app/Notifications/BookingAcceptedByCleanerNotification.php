<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Booking;

class BookingAcceptedByCleanerNotification extends Notification
{
    use Queueable;

    protected $booking;

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
            ->subject('Booking Accepted By Cleaner')
            ->greeting('Hello Admin,')
            ->line(
                'Booking #' . $this->booking->id .
                ' has been accepted by a cleaner.'
            )
            ->line(
                'Cleaner: ' .
                ($this->booking->cleaner->name ?? 'N/A')
            )
            ->line(
                'Customer: ' .
                $this->booking->user->name
            )
            ->action(
                'View Booking',
                url('/admin/bookings')
            )
            ->line('Thank you for using HomeShine.');
    }

    public function toArray($notifiable)
    {
        return [
            'booking_id' => $this->booking->id,
            'message' =>
                'Booking #' .
                $this->booking->id .
                ' accepted by cleaner ' .
                ($this->booking->cleaner->name ?? 'Unknown')
        ];
    }
}
