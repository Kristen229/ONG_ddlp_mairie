<?php
namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\AuditLog;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function store(StoreActivityRequest $request)
    {
        $path = $request->file('attachment')->store('activities', 'public');

        $activity = Activity::create([
            'user_id' => Auth::id(),
            'titre' => $request->titre,
            'description' => $request->description,
            'lieu' => $request->lieu,
            'date' => $request->date,
            'attachment' => $path,
            'beneficiaries_expected' => $request->beneficiaries_expected,
            'budget_expected' => $request->budget_expected,
            'target_audience' => $request->target_audience,
            'is_visible' => false,
            'status' => Activity::STATUS_PENDING,
        ]);

        AuditLog::record('activity.create_user', "Activité soumise: {$activity->titre}", ['activity_id' => $activity->id]);

        return redirect()->back()->with('success', 'Activité créée avec succès.');
    }

    public function show($id)
    {
        $activity = Activity::where('is_visible', true)
            ->where('status', Activity::STATUS_PUBLISHED)
            ->with('user.domaines')
            ->findOrFail($id);

        return view('pages.activity-details', compact('activity'));
    }

    public function update(UpdateActivityRequest $request, $id)
    {
        $activity = Activity::findOrFail($id);
        abort_unless($activity->user_id === Auth::id(), 403);

        $data = [
            'titre' => $request->titre,
            'description' => $request->description,
            'lieu' => $request->lieu,
            'date' => $request->date,
            'beneficiaries_expected' => $request->beneficiaries_expected,
            'budget_expected' => $request->budget_expected,
            'target_audience' => $request->target_audience,
            'is_visible' => false,
            'status' => Activity::STATUS_PENDING,
        ];

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('activities', 'public');
        }

        $activity->update($data);
        AuditLog::record('activity.resubmit', "Activité resoumise: {$activity->titre}", ['activity_id' => $activity->id]);

        return redirect()->back()->with('success', 'Activité modifiée et renvoyée pour validation.');
    }
}
