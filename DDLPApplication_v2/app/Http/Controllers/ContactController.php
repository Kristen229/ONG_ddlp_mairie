<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Mail::raw($validated['message'], function ($msg) use ($validated) {
            $msg->to(config('mail.from.address'))
                ->subject("Contact de {$validated['nom']}")
                ->replyTo($validated['email']);
        });

        return redirect()->back()->with('success', 'Message envoyé avec succès.');
    }
}
