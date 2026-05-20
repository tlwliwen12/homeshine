<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingRescheduledNotification extends Notification
{
    use Queueable;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Booking Rescheduled')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A booking has been rescheduled.')
            ->line('Booking ID: #' . $this->booking->id)
            ->line('Service: ' . $this->booking->service->name)
            ->line('New Date: ' . $this->booking->booking_date)
            ->line('New Time: ' . \Carbon\Carbon::parse(
                $this->booking->booking_time
            )->format('h:i A'))
            ->action(
                'View Booking',
                url('/cleaner/bookings')
            )
            ->line('Please check the updated schedule.');
    }

    public function toArray($notifiable): array
    {
        return [

            'message' =>
                'Booking #'.$this->booking->id.
                ' has been rescheduled to '.
                $this->booking->booking_date.
                ' at '.
                \Carbon\Carbon::parse(
                    $this->booking->booking_time
                )->format('h:i A'),

            'service' =>
                $this->booking->service->name,

            'customer' =>
                $this->booking->user->name,

        ];
    }
}
