<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public array $contactData)
    {
    }

    public function envelope(): Envelope
    {
        $fullName = trim(($this->contactData['first_name'] ?? '') . ' ' . ($this->contactData['last_name'] ?? ''));

        return new Envelope(
            subject: 'New Contact Message from ' . ($fullName !== '' ? $fullName : 'Website Visitor'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-message',
        );
    }
}
