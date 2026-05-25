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
        return (new MailMessage)
            ->subject('Cleaner Account Approved')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your cleaner account has been approved by the HomeShine administrator.')
            ->line('You can now log in and access the cleaner dashboard.')
            ->action('Login Now', url('/login'))
            ->line('Thank you for joining HomeShine!');
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Cleaner Account Approved',
            'message' => 'Your cleaner account has been approved. You can now log in.'
        ];
    }
}
