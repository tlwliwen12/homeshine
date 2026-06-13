<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class JobCompletedNotification extends Notification
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
    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->markdown('mail.notification', [
            'title' => '🎉 Job Completed',
            'name' => $notifiable->name,
            'message' => 'Great news! Your cleaning service has been completed successfully.',
            'details' => [
                'Service' => $this->booking->service->name,
                'Cleaner' => $this->booking->cleaner->name ?? 'Not Assigned',
                'Date' => $this->booking->booking_date,
                'Time' => $this->booking->booking_time,
                'Status' => 'Completed',
            ],
            'url' => url('/customer/bookings')
        ]);
}

    public function toArray($notifiable)
{
    return [
        'title' => 'Job Completed',
        'message' => 'Your cleaning job has been completed successfully.',
        'booking_id' => $this->booking->id,
        'status' => 'Completed',
    ];
}
}
