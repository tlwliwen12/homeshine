<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BookingCancelledNotification extends Notification
{
    use Queueable;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toArray($notifiable)
    {
        return [

            'message' =>
                'Booking #' . $this->booking->id .
                ' has been cancelled by customer.',

            'service' =>
                $this->booking->service->name,

            'customer' =>
                $this->booking->user->name

        ];
    }

    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)

            ->subject('Booking Cancelled Notification')

            ->greeting('Hello!')

            ->line(
                'A customer has cancelled a booking.'
            )

            ->line(
                'Service: ' .
                $this->booking->service->name
            )

            ->line(
                'Customer: ' .
                $this->booking->user->name
            )

            ->line(
                'Booking ID: #' .
                $this->booking->id
            )

            ->line(
                'Please check the admin dashboard for more details.'
            )

            ->salutation('HomeShine System');
    }
}
