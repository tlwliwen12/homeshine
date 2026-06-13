<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CleanerJobPaidNotification extends Notification
{
    use Queueable;

    public $booking;

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
            'title' => 'Job Confirmed',
            'name' => $notifiable->name,
            'message' => 'Good news! The customer has completed payment for this booking. The job is now confirmed and ready to proceed.',
            'details' => [
                'Service' => $booking->service->name,
                'Booking ID' => $booking->id,
                'Customer' => $booking->user->name,
                'Date' => $booking->booking_date,
                'Time' => $booking->booking_time,
                'Status' => 'Paid',
            ],
            'url' => url('/cleaner/jobs')
        ]);
}

    public function toArray($notifiable)
    {
        return [
            'title' => 'Job Confirmed',
            'message' =>
                'Booking #' . $this->booking->id .
                ' has been paid and is ready to start.',
            'booking_id' => $this->booking->id,
            'status' => 'Paid'
        ];
    }
}
