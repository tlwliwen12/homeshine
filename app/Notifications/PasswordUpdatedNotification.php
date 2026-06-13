<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordUpdatedNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
{
    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->markdown('mail.notification', [
            'title' => '🔐 Password Updated',
            'name' => $notifiable->name,
            'message' => 'Your HomeShine account password has been successfully updated.',
            'details' => [
                'Security Notice' => 'If this was not you, please contact support immediately.',
            ],
            'url' => url('/login')
        ]);
}

    public function toArray($notifiable)
{
    return [
        'title' => 'Password Updated',
        'message' => 'Password was updated successfully.',
        'status' => 'Security',
    ];
}
}
