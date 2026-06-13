<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminJobCompletedNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $booking = $this->booking;

        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->markdown('mail.notification', [
                'title' => '🧹 Job Completed',
                'name' => 'Admin ' . $notifiable->name,
                'message' => 'A cleaning job has been marked as COMPLETED.',
                'details' => [
                    'Service' => $booking->service->name,
                    'Booking ID' => $booking->id,
                    'Customer' => $booking->user->name,
                    'Cleaner' => $booking->cleaner ? $booking->cleaner->name : 'Not Assigned',
                    'Date' => $booking->booking_date,
                    'Time' => $booking->booking_time,
                    'Status' => $booking->status,
                ],
                'url' => url('/admin/bookings')
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Job Completed',
            'message' => 'Booking #' . $this->booking->id . ' completed.',
            'booking_id' => $this->booking->id,
            'status' => 'Completed',
            'customer' => $this->booking->user->name,
            'cleaner' => $this->booking->cleaner ? $this->booking->cleaner->name : null,
        ];
    }
}
