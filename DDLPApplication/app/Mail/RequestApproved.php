<?php

namespace App\Mail;


/*use Faker\Provider\ar_EG\Address;*/
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Requests;

use Illuminate\Mail\Mailables\Address;

class RequestApproved extends Mailable
{
    use Queueable, SerializesModels;

    
    public $request;
    public $filePath;
    
        /**
     * Crée une nouvelle instance de message.
     *
     * @param  mixed  $request
     * @param  string|null  $filePath
     * @return void
     */
    public function __construct($request, $filePath = null)
    {
        $this->request = $request;
        $this->filePath = $filePath;
    }
    
        /**
     * Récupérer l'enveloppe du message.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Demande acceptée',
            from: new Address('oloukaaureole@gmail.com', 'VotreApp')
        );
    }

    /**
     * Définir le contenu du message.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.approved'
        );
    }

    /**
     * Obtenir les pièces jointes pour le message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if ($this->filePath) {
            return [
                \Illuminate\Mail\Mailables\Attachment::fromPath(
                    storage_path('app/' . $this->filePath)
                ),
            ];
        }

        return [];
    }
}
