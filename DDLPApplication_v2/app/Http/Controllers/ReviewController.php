<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\User;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $user = User::findOrFail($id);

        Review::create([
            'user_id' => $user->id,
            'author_name' => $request->author_name,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Votre avis a été publié avec succès !');
    }

    public function getActivitiesForAssociation($id)
    {
        $user = User::findOrFail($id);
        $activities = $user->activities()->where('is_visible', true)->get(['id', 'titre']);
        return response()->json($activities);
    }

    public function storeFromHome(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'activity_id' => 'nullable|exists:activities,id',
            'author_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Review::create([
            'user_id' => $request->user_id,
            'activity_id' => $request->activity_id,
            'author_name' => $request->author_name,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Votre avis a été publié avec succès ! Merci pour votre retour.');
    }
}
