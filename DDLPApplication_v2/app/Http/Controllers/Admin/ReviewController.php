<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        // On récupère les avis avec l'association et l'activité
        $reviews = Review::with(['user', 'activity'])->latest()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function approve($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['is_approved' => true]);
        AuditLog::record('review.approve', 'Avis approuvé', ['review_id' => $review->id]);
        
        return redirect()->back()->with('success', 'L\'avis a été approuvé avec succès.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        AuditLog::record('review.delete', 'Avis supprimé', ['review_id' => $review->id]);
        $review->delete();

        return redirect()->back()->with('success', 'L\'avis a été supprimé.');
    }
}
