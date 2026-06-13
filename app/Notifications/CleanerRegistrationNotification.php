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
    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->markdown('mail.notification', [
            'title' => '🆕 New Cleaner Registration',
            'name' => 'Admin',
            'message' => $this->cleaner->name . ' has registered as a cleaner and is waiting for approval.',
            'details' => [
                'Cleaner Name' => $this->cleaner->name,
                'Status' => 'Pending Approval',
            ],
            'url' => url('/admin/cleaners')
        ]);
}

    public function toArray($notifiable)
{
    return [
        'title' => 'New Cleaner Registration',
        'message' => $this->cleaner->name . ' registered as a cleaner.',
        'cleaner_id' => $this->cleaner->id,
        'status' => 'Pending Approval',
    ];
}
}
