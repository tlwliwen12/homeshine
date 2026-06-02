<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CleanerPayoutNotification extends Notification
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

    public function toArray($notifiable)
    {
        return [

            'message' =>
                'Company has paid your earnings for Booking #'
                . $this->booking->id

        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)

            ->subject('Cleaner Payout Completed')

            ->greeting('Hello ' . $notifiable->name . ',')

            ->line(
                'Your payment for completed cleaning service has been processed.'
            )

            ->line(
                'Booking ID: #' . $this->booking->id
            )

            ->line(
                'Service: ' . $this->booking->service->name
            )

            ->action(
                'View Transactions',
                url('/cleaner/transactions')
            )

            ->line(
                'Thank you for working with HomeShine.'
            );
    }
}
