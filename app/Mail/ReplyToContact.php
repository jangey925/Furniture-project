<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyToContact extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;
    public $confirmationMessage;

    /**
     * Create a new message instance.
     *
     * @param string $messageContent
     */
    public function __construct(string $messageContent , string $confirmationMessage)
    {
        $this->messageContent = $messageContent; 
         $this->confirmationMessage = $confirmationMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.reply')
            ->with([
                'messageContent' => $this->messageContent, 
                'confirmationMessage' => $this->confirmationMessage,
            ]);
    }
}