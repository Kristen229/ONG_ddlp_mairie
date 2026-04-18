<?php
namespace App\Mail;

use App\Models\AssociationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestRejected extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public AssociationRequest $assocRequest,
        public string $motif
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Votre demande a été refusée');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.rejected');
    }

    public function attachments(): array
    {
        return [];
    }
}
