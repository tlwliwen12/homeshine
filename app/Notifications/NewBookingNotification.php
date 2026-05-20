<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewBookingNotification extends Notification
{
    use Queueable;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    // Database + Email
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    // Email
    public function toMail($notifiable)
    {
        return (new MailMessage)

            ->subject('New Booking Received')

            ->greeting('Hello '.$notifiable->name.',')

            ->line('A new booking has been created.')

            ->line('Booking ID: #'.$this->booking->id)

            ->line('Customer: '.$this->booking->user->name)

            ->line('Service: '.$this->booking->service->name)

            ->line('Date: '.$this->booking->booking_date)

            ->line('Time: '.$this->booking->booking_time)

            ->line('Address: '.$this->booking->address)

            ->action(
                'View Dashboard',
                url('/login')
            )

            ->line('Please review this booking.');
    }

    // Database notification
    public function toArray($notifiable): array
    {
        return [

            'message' =>
                'New booking #'.$this->booking->id.' has been created.',

            'service' =>
                $this->booking->service->name,

            'customer' =>
                $this->booking->user->name,

        ];
    }
}
