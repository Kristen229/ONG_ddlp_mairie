<?php
namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function store(StoreActivityRequest $request)
    {
        $path = $request->file('attachment')->store('activities', 'public');

        Activity::create([
            'user_id' => Auth::id(),
            'titre' => $request->titre,
            'description' => $request->description,
            'lieu' => $request->lieu,
            'date' => $request->date,
            'attachment' => $path,
            'beneficiaries_expected' => $request->beneficiaries_expected,
            'budget_expected' => $request->budget_expected,
            'target_audience' => $request->target_audience,
            'is_visible' => false, // Sécurité : Forcer l'invisibilité par défaut
        ]);

        return redirect()->back()->with('success', 'Activité créée avec succès.');
    }

    public function update(UpdateActivityRequest $request, $id)
    {
        $activity = Activity::findOrFail($id);

        $data = [
            'titre' => $request->titre,
            'description' => $request->description,
            'beneficiaries_actual' => $request->beneficiaries_actual,
            'budget_actual' => $request->budget_actual,
            'actual_date' => $request->actual_date,
        ];

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('activities', 'public');
        }

        $activity->update($data);
        return redirect()->back()->with('success', 'Activité modifiée.');
    }
}
