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
        return (new MailMessage)

            ->subject('Password Updated Successfully')

            ->greeting('Hello ' . $notifiable->name . ',')

            ->line('Your HomeShine account password has been updated successfully.')

            ->line('If you did not perform this action, please contact support immediately.')

            ->action(
                'Login Now',
                url('/login')
            )

            ->line('Thank you for using HomeShine!');
    }

    public function toArray($notifiable)
    {
        return [

            'title' => 'Password Updated',

            'message' =>
                'Your account password was updated successfully.'

        ];
    }
}
