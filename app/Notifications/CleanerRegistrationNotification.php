<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CleanerRegistrationNotification extends Notification
{
    use Queueable;

    public $cleaner;

    public function __construct($cleaner)
    {
        $this->cleaner = $cleaner;
    }

    public function via($notifiable)
    {
        return ['mail','database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Cleaner Registration')
            ->greeting('Hello Admin!')
            ->line(
                $this->cleaner->name .
                ' has registered as a cleaner.'
            )
            ->line(
                'The account is waiting for approval.'
            )
            ->action(
                'Review Cleaner',
                url('/admin/cleaners')
            );
    }

    public function toArray($notifiable)
    {
        return [

            'title' =>
                'New Cleaner Registration',

            'message' =>
                $this->cleaner->name .
                ' has registered as a cleaner and is waiting for approval.',

            'cleaner_id' =>
                $this->cleaner->id

        ];
    }
}
