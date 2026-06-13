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
    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->markdown('mail.notification', [
            'title' => '📌 Booking Accepted',
            'name' => 'Admin',
            'message' => 'A booking has been accepted by a cleaner.',
            'details' => [
                'Booking ID' => $this->booking->id,
                'Cleaner' => $this->booking->cleaner->name ?? 'N/A',
                'Customer' => $this->booking->user->name,
            ],
            'url' => url('/admin/bookings')
        ]);
}

    public function toArray($notifiable)
{
    return [
        'title' => 'Booking Accepted',
        'message' => 'Booking #' . $this->booking->id . ' accepted by cleaner.',
        'booking_id' => $this->booking->id,
        'cleaner' => $this->booking->cleaner->name ?? null,
        'customer' => $this->booking->user->name,
    ];
}
}
