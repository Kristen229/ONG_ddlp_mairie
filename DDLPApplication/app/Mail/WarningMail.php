<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WarningMail extends Mailable
{
    use Queueable, SerializesModels;

    public $activity;

    public function __construct($activity)
    {
        $this->activity = $activity;
    }

    public function build()
    {
        return $this->subject('Avertissement concernant votre publication')
                    ->view('emails.warning')
                    ->with([
                        'titre' => $this->activity->titre,
                        'description' => $this->activity->description,
                    ]);
    }
}


