<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReplyToContactNotification extends Notification
{
    use Queueable;

    private $messageContent;
    private $confirmationMessage;

    /**
     * Create a new notification instance.
     *
     * @param string $messageContent
     * @param string $confirmationMessage
     */
    public function __construct(string $messageContent, string $confirmationMessage)
    {
        $this->messageContent = $messageContent;
        $this->confirmationMessage = $confirmationMessage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reply from Admin')
            ->view('admin.reply', [
                'messageContent' => $this->messageContent,
                'confirmationMessage' => $this->confirmationMessage,
            ]);
    }
}
