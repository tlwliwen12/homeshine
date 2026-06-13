<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetNotification extends Notification
{
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail','database'];
    }

    public function toMail($notifiable)
{
    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->markdown('mail.notification', [
            'title' => '🔐 Password Reset Request',
            'name' => $notifiable->name,
            'message' => 'We received a request to reset your password. Click the button below to proceed.',
            'details' => [
                'Important' => 'This link will expire soon for security reasons.',
            ],
            'url' => url('/reset-password/' . $this->token)
        ]);
}

public function toArray($notifiable)
{
    return [
        'title' => 'Password Reset Requested',
        'message' => 'A password reset request was initiated.',
        'status' => 'Security',
    ];
}
}
