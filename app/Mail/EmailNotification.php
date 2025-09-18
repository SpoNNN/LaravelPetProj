<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;


    public function __construct(User $user)
    {
        $this->user = $user;
    }

 
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Вы успешно зарегистрировались, добро пожаловать на сайт!',
        );
    }

   
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.registered',
            with: [
                'user' => $this->user, 
            ],
        );
    }

    
    public function attachments(): array
    {
        return [];
    }
}
