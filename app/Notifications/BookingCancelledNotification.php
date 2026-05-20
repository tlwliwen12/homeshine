<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookingCancelledNotification extends Notification
{
    use Queueable;

    public $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    // Send via database + email
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    // Email notification
    public function toMail($notifiable)
    {
        return (new MailMessage)

            ->subject('Booking Cancelled')

            ->greeting('Hello '.$notifiable->name.',')

            ->line('A booking has been cancelled.')

            ->line('Booking ID: #'.$this->booking->id)

            ->line('Customer: '.$this->booking->user->name)

            ->line('Service: '.$this->booking->service->name)

            ->line('Date: '.$this->booking->booking_date)

            ->line('Time: '.$this->booking->booking_time)

            ->line(
                $this->booking->payment_status == 'Paid'
                ? 'Refund request is pending.'
                : 'No payment was made.'
            )

            ->action(
                'View Dashboard',
                url('/login')
            )

            ->line('Thank you for using HomeShine.');
    }

    // Database notification
    public function toArray($notifiable)
    {
        return [

            'booking_id' => $this->booking->id,

            'message' =>
                'Booking #'.$this->booking->id.
                ' has been cancelled.',

        ];
    }
}
