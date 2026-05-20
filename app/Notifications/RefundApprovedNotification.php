<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RefundApprovedNotification extends Notification
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
            ->subject('Refund Approved')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your refund request has been approved.')
            ->line('Booking ID: #' . $this->booking->id)
            ->line('Service: ' . $this->booking->service->name)
            ->line('Refund Status: Refunded')
            ->action(
                'View Booking',
                url('/customer/bookings')
            )
            ->line('Thank you for using HomeShine!');
    }

    public function toArray($notifiable): array
    {
        return [

            'message' =>
                'Refund requested for booking #'.$this->booking->id,

            'service' =>
                $this->booking->service->name,

            'customer' =>
                $this->booking->user->name,

        ];
    }
}
