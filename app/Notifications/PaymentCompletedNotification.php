<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentCompletedNotification extends Notification
{
    use Queueable;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)

            ->subject('Payment Completed')

            ->greeting('Hello '.$notifiable->name.',')

            ->line(
                'Payment completed for booking #'.$this->booking->id
            )

            ->line(
                'Service: '.$this->booking->service->name
            )

            ->line(
                'Customer: '.$this->booking->user->name
            )

            ->line('Thank you.');
    }

    public function toArray($notifiable): array
    {
        return [

            'message' =>
                'Payment completed for booking #'.$this->booking->id,

            'service' =>
                $this->booking->service->name,

            'customer' =>
                $this->booking->user->name,

        ];
    }
}
