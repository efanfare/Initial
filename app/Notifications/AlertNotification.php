<?php

namespace App\Notifications;

use App\Models\Role;
use Error;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AlertNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(
        private string $description,
        private ?string $subject = null,
        private ?int $senderId = null,
        private ?string $link = null,
        private ?bool $viaEmail = false,
        private ?bool $viaDatabase = true,
        private ?int $userAlertId = null,
        private ?string $actionLinkLabel = null,
        private bool $forceSendEmailToUnverifiedStudent = false
    ) {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {

        return ['database'];
        if (!$this->viaDatabase && !$this->viaEmail) {
            throw new Error("Notification must be sent via database or email. Notification description: $this->description");
        }



        $this->viaEmail = false;
        $this->viaDatabase = true;

        $via = [];
        if ($this->viaDatabase) {
            array_push($via, 'database');
        }
        if ($this->viaEmail) {
            array_push($via, 'mail');
        }

        return $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // We only want to display the link to unsubscribe for students if
        // the email is notification. For other types of emails like reset password
        // we don't want to display that link, therefore we will use this
        // variable as a flag to check for that.
        $isAlertNotification = true;

        return is_null($this->link)
            ? (new MailMessage)
            ->subject($this->subject ?? __('Efanfare Notification'))
            ->line($this->description)
            ->line(__('Thank you for using Efanfare.'))
            ->markdown('vendor.notifications.email', compact('notifiable', 'isAlertNotification'))
            : (new MailMessage)
            ->subject($this->subject ?? __('Efanfare Notification'))
            ->line($this->description)
            ->action($this->actionLinkLabel ?? __('Action Link'), $this->link)
            ->line(__('Thank you for using Efanfare.'))
            ->markdown('vendor.notifications.email', compact('notifiable', 'isAlertNotification'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'subject' =>  $this->subject ? $this->subject : '',
            'description' => $this->description,
            'link' => $this->link,
            'senderId' => $this->senderId,
            'userAlertId' => $this->userAlertId,
        ];
    }
}
