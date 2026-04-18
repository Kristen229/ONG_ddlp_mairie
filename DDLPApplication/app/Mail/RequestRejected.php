<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;


class RequestRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $request;

        /**
     * Crée une nouvelle instance de message.
     *
     * @param  mixed  $request
     * @return void
     */

    public function __construct($request)
    {
        $this->request = $request;
    }

        /**
     * Construire le message.
     *
     * @return \Illuminate\Mail\Mailable
     */

    public function build()
    {
        $email = $this->subject('Demande refusée')
                      ->view('emails.rejected') // Vue de l'email
                      ->with(['request' => $this->request]); // Passer la demande à la vue

        return $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Request Rejected',
            from: new Address('oloukaaureole@gmail.com', 'VotreApp')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.rejected',
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

