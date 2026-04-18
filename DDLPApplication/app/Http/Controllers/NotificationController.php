<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

use App\Models\User;

class NotificationController extends Controller
{
    public function send(Request $request)
    {
        // Valider les données
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'recipient_name' => 'required|string|max:255',
            'recipient_email' => 'required|email',
        ]);

        // Récupérer l'ID de l'utilisateur destinataire à partir de son email
        $recipient = User::where('email', $request->recipient_email)->first();

        if (!$recipient) {
            // Si l'utilisateur n'existe pas dans la base de données
            return redirect()->back()->with('error', 'Utilisateur non trouvé.');
        }

        // Créer la notification avec l'ID du destinataire
        Notification::create([
            'title' => $request->title,
            'message' => $request->message,
            'recipient_name' => $request->recipient_name,
            'recipient_email' => $request->recipient_email,
            'user_id' => $recipient->id,  // ID de l'utilisateur destinataire
        ]);

        return redirect()->route('admin');
    }
}
