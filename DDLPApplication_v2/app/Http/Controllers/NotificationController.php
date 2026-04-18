<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'recipient_name' => 'required|string',
            'recipient_email' => 'required|email',
        ]);

        Notification::create($validated);

        return redirect()->back()->with('success', 'Notification envoyée.');
    }
}
