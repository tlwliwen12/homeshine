<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CleanerApprovedNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
{
    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->markdown('mail.notification', [
            'title' => '🎉 Cleaner Account Approved',
            'name' => $notifiable->name,
            'message' => 'Your cleaner account has been approved by the HomeShine administrator.',
            'details' => [
                'Status' => 'Approved',
                'Access' => 'You can now log in to the cleaner dashboard',
            ],
            'url' => url('/login')
        ]);
}

    public function toArray($notifiable)
{
    return [
        'title' => 'Cleaner Approved',
        'message' => 'Your cleaner account has been approved.',
        'status' => 'Approved',
    ];
}
}
