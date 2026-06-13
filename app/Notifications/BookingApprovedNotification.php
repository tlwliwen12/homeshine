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

    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->markdown('mail.notification', [
            'title' => '📌 Booking Approved',
            'name' => $notifiable->name,
            'message' => 'Your booking has been approved successfully.',
            'details' => [
                'Service' => $booking->service->name,
                'Date' => $booking->booking_date,
                'Time' => $booking->booking_time,
                'Cleaner' => $booking->cleaner->name ?? 'Not Assigned',
                'Cleaner Phone' => $booking->cleaner->phone ?? '-',
                'Cleaner Gender' => $booking->cleaner->gender ?? '-',
            ],
            'url' => url('/customer/bookings')
        ]);
}

    public function toArray($notifiable)
{
    return [
        'title' => 'Booking Approved',
        'message' => 'Your booking #' . $this->booking->id . ' has been approved.',
        'booking_id' => $this->booking->id,
        'status' => 'Approved',
    ];
}
}
