<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorCodeNotification extends Notification
{
    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = 'http://localhost:8000/password/reset';
        return (new MailMessage)
            ->subject(__('Verification Code'))
            ->line(__('Your verification code is :number', ['number' => $notifiable->two_factor_code]))
            // The number 15 is from User model method generateTwoFactorCode()
            // ->line(__('The code will expire in :number minutes.', ['number' => 15]))
            // ->line(__('If you have not tried to login, reset your password immediately.'))
            // ->action(__('Reset Password'), $url)
            ->line(__('Thank you for using Efanfare.'));
    }
}
