<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CleanerRejectedNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Cleaner Account Application Result')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('We regret to inform you that your cleaner account application has not been approved.')
            ->line('If you believe this is a mistake, please contact HomeShine support.')
            ->action('Contact Support', url('/'))
            ->line('Thank you for your interest in HomeShine.');
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Cleaner Account Rejected',
            'message' => 'Your cleaner account application has been rejected.'
        ];
    }
}
