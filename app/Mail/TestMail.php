<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $subject , $body ;
    public function __construct($subject,$body)
    {
        $this->subject = $subject ;
        $this->body  = $body ;
    }

    /**
     * Get the message envelope.
     */
    
    public function envelope(): Envelope
    {
        return new Envelope(
            // subject: 'Test Mail',
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            
            view: 'email',
            with: [
                'subject' => $this->subject, // Passez l'adresse e-mail en tant que variable à la vue.
                'body' => $this->body, // Passez l'adresse e-mail en tant que variable à la vue.
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
