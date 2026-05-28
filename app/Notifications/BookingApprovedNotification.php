<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingApprovedNotification extends Notification
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
        $booking = $this->booking;

            $cleanerName = $booking->cleaner ? $booking->cleaner->name : 'Not Assigned';
            $cleanerPhone = $booking->cleaner ? $booking->cleaner->phone : '-';
            $cleanerGender = $booking->cleaner ? $booking->cleaner->gender : '-';

        return (new MailMessage)
            ->subject('Booking Approved')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('A booking has been approved.')
            ->line('Customer Name: ' . $this->booking->user->name)
            ->line('Service: ' . $this->booking->service->name)
            ->line('Date: ' . $this->booking->booking_date)
            ->line('Time: ' . $this->booking->booking_time)
            ->line('Cleaner Assigned: ' . $cleanerName)
            ->line('Cleaner Gender: ' . $cleanerGender)
            ->line('Cleaner Phone: ' . $cleanerPhone)
            ->action('View Booking', url('/customer/bookings'))
            ->line('Thank you for using HomeShine!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' =>
                'Booking #' . $this->booking->id .
                ' has been approved.'
        ];
    }
}
