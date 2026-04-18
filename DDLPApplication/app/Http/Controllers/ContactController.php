<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // Validation simple
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Envoyer l'email
        Mail::send([], [], function ($message) use ($request) {
            $message->to('ddlpmairie@gmail.com')
                    ->subject($request->subject)
                    ->from(
                        config('mail.from.address'), 
                        config('mail.from.name')
                    )
                    ->replyTo($request->email, $request->name)                    
                    ->text($request->message); // ✅ Remplacer setBody par text()
        });

        return back()->with('success', 'Votre message a été envoyé avec succès !');
    }
}
