<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Activity;
use App\Models\Notification;
use App\Models\Requests;
use App\Models\User;

use Illuminate\Support\Facades\Mail; 
use App\Mail\WarningMail;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ActivityRequest;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function store(ActivityRequest $request)
    {

        // Sauvegarder l'activité
        $activity = new Activity();
        $activity->titre = $request->titre;
        $activity->description = $request->description;
        $activity->lieu = $request->lieu;
        $activity->date = $request->date; 
        $activity->beneficiaries_expected = $request->beneficiaries_expected;
        $activity->budget_expected = $request->budget_expected;
        $activity->user_id = Auth::id(); // Assurez-vous que l'utilisateur est authentifié

        // Gérer la pièce jointe
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            $activity->attachment = basename($path); // Sauvegarde du nom du fichier dans la colonne 'attachment'
        }

        $activity->save();

        // Rediriger vers la page des activités après la publication
        return redirect()->route('user.show', ['id' => $activity->user_id])->with('success', 'Activité créée avec succès');

    }

    public function validatActivity($id)
    {
        $activity = Activity::findOrFail($id);

        // ===== SCORE CALCUL =====

        $beneficiaryScore = 0;

        if ($activity->beneficiaries_expected > 0 &&
            $activity->beneficiaries_actual !== null) {

            $beneficiaryScore =
            ($activity->beneficiaries_actual /
            $activity->beneficiaries_expected) * 100;

            $beneficiaryScore = min($beneficiaryScore, 100);
        }

        $budgetScore = 0;

        if ($activity->budget_expected !== null &&
            $activity->budget_actual !== null) {

            $budgetScore =
            ($activity->budget_actual <= $activity->budget_expected)
            ? 100 : 50;
        }

        $delayScore = 0;

        if ($activity->planned_date && $activity->actual_date) {

            $delayScore =
            ($activity->actual_date <= $activity->planned_date)
            ? 100 : 50;
        }

        $finalScore =
        ($beneficiaryScore * 0.4) +
        ($budgetScore * 0.3) +
        ($delayScore * 0.3);

        // ===== SAUVEGARDE =====

        $activity->score = $finalScore;
        $activity->evaluation_status = 'conforme';
        $activity->is_visible = true;

        $activity->save();

        return back()->with('success','Activité validée et score calculé.');
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);

        // Masquer l'activité
        $activity->is_visible = false;

        // Mettre statut rejeté (très important pour l'évaluation)
        $activity->evaluation_status = 'non_conforme';

        $activity->save();

        return back()->with('success', "Activité retirée de l'interface.");
    }

    public function update(ActivityRequest $request, $id)
    {
        $activity = Activity::findOrFail($id);
    
        // Validation des données
        $validatedData = $request->validated();
    
        // Mise à jour des champs
        $activity->titre = $validatedData['titre'];
        $activity->description = $validatedData['description'];
        $activity->beneficiaries_actual = $validatedData['beneficiaries_actual'];
        $activity->budget_actual = $validatedData['budget_actual'];
        $activity->actual_date = $validatedData['actual_date'];

    
        // Gestion de l'image si elle est fournie
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('attachments', 'public');
            $activity->attachment = $path;
        }
    
        // Enregistrement des modifications
        $activity->save();
    
        // Redirection ou retour de réponse
        return redirect()->back()->with('success', 'Activité modifiée avec succès.');
    }

    public function index(Request $request, \App\Services\StatsService $statsService)
    {
        $data = $statsService->getAdminDashboardData();
        
        // Custom logic for ActivityController
        $data['user'] = Auth::user();
        $data['users'] = User::paginate(10);
        
        $search = $request->input('search');
        $data['activities'] = Activity::when($search, function ($query, $search) {
            return $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        })->with('user')->get();

        return view('admin', $data);
    }

    public function sendWarning($id)
    {
        $activity = Activity::findOrFail($id);

        $user = $activity->user;

        // Mise à jour statut
        $activity->evaluation_status = 'avertissement';
        $activity->save();

        // Email avertissement
        Mail::to($user->email)->send(new WarningMail($activity));

        return back()->with('success', "Avertissement envoyé.");
    }

    public function createAdmin()
    {
        // On récupère toutes les associations/ONG
        $users = User::whereIn('groupe', ['association', 'ong'])->get();

        return view('admin.activities.create', compact('users'));
    }

    public function storeAdmin(ActivityRequest $request)
    {

        // Sauver l'image
        $filePath = $request->file('attachment')->store('attachments', 'public');

        Activity::create([
            'user_id' => $request->user_id,
            'titre' => $request->titre,
            'description' => $request->description,
            'attachment' => $filePath,
            'lieu' => $request->lieu,
            'date' => $request->date,
        ]);

        return redirect()->route('activities.index')->with('success', 'Activité ajoutée avec succès.');
    }

    public function validateActivity($id)
    {
        $activity = Activity::findOrFail($id);

        // 1️⃣ Taux bénéficiaires
        $beneficiaryScore = 0;

        if ($activity->beneficiaries_expected > 0 && 
            $activity->beneficiaries_actual !== null) {

            $beneficiaryScore = 
            ($activity->beneficiaries_actual / 
            $activity->beneficiaries_expected) * 100;

            $beneficiaryScore = min($beneficiaryScore, 100);
        }

        // 2️⃣ Respect budget
        $budgetScore = 0;

        if ($activity->budget_expected !== null &&
            $activity->budget_actual !== null) {

            if ($activity->budget_actual <= $activity->budget_expected) {
                $budgetScore = 100;
            } else {
                $budgetScore = 50;
            }
        }

        // 3️⃣ Respect délai
        $delayScore = 0;

        if ($activity->date && $activity->actual_date) {

            if ($activity->actual_date <= $activity->date) {
                $delayScore = 100;
            } else {
                $delayScore = 50;
            }
        }

        // 🎯 Score final
        $finalScore = ($beneficiaryScore * 0.4) +
                    ($budgetScore * 0.3) +
                    ($delayScore * 0.3);

        $activity->score = $finalScore;
        $activity->evaluation_status = 'conforme';
        $activity->save();

        return back()->with('success', 'Activité validée et score calculé.');
    }
}
