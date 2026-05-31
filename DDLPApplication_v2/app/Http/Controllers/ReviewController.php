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
            'website' => 'prohibited',
            'author_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:2000',
        ]);

        $user = User::where('is_approved', true)->findOrFail($id);

        Review::create([
            'user_id' => $user->id,
            'author_name' => $request->author_name,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => false,
        ]);

        return redirect()->back()->with('success', 'Votre avis a été soumis et sera visible après validation.');
    }

    public function getActivitiesForAssociation($id)
    {
        $user = User::where('is_approved', true)->findOrFail($id);
        $activities = $user->activities()->where('is_visible', true)->get(['id', 'titre']);
        return response()->json($activities);
    }

    public function storeFromHome(Request $request)
    {
        $request->validate([
            'website' => 'prohibited',
            'user_id' => 'required|exists:users,id',
            'activity_id' => 'nullable|exists:activities,id',
            'author_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:2000',
        ]);

        $user = User::where('is_approved', true)->findOrFail($request->user_id);

        Review::create([
            'user_id' => $user->id,
            'activity_id' => $request->activity_id,
            'author_name' => $request->author_name,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => false,
        ]);

        return redirect()->back()->with('success', 'Votre avis a été soumis et sera visible après validation.');
    }
}
