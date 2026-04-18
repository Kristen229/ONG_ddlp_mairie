<?php
namespace App\Mail;

use App\Models\AssociationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestApproved extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public AssociationRequest $assocRequest,
        public string $motif
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Votre demande a été approuvée');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.approved');
    }

    public function attachments(): array
    {
        $attachments = [];
        if ($this->assocRequest->pdf_path) {
            $attachments[] = \Illuminate\Mail\Mailables\Attachment::fromStorageDisk('public', $this->assocRequest->pdf_path);
        }
        return $attachments;
    }
}
