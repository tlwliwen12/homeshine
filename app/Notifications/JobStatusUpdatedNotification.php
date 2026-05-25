<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobStatusUpdatedNotification extends Notification
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
        return (new MailMessage)
            ->subject('Cleaning Job Status Updated')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line(
                'Your booking for '
                . $this->booking->service->name
                . ' has been updated.'
            )
            ->line(
                'Current Status: '
                . $this->booking->status
            )
            ->action(
                'View My Bookings',
                url('/customer/bookings')
            );
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Job Status Updated',
            'message' =>
                'Your booking for '
                . $this->booking->service->name
                . ' is now '
                . $this->booking->status . '.',
            'status' => $this->booking->status
        ];
    }
}
