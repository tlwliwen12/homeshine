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

    $booking = $this->booking;

            $cleanerName = $booking->cleaner ? $booking->cleaner->name : 'Not Assigned';
            $cleanerPhone = $booking->cleaner ? $booking->cleaner->phone : '-';
            $cleanerGender = $booking->cleaner ? $booking->cleaner->gender : '-';

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
            ->line('Date: ' . $this->booking->booking_date)
            ->line('Time: ' . $this->booking->booking_time)
            ->line('Cleaner Assigned: ' . $cleanerName)
            ->line('Cleaner Gender: ' . $cleanerGender)
            ->line('Cleaner Phone: ' . $cleanerPhone)
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
