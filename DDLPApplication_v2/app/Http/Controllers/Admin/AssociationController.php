<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserStep1Request;
use App\Http\Requests\StoreUserStep2Request;
use App\Http\Requests\StoreUserStep3Request;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AssociationController extends Controller
{
    public function index()
    {
        $users = User::where('is_approved', true)->with('domaines')->paginate(20);
        return view('admin.associations.index', compact('users'));
    }

    public function showPage($id)
    {
        $user = User::with(['domaines', 'boardMembers'])->findOrFail($id);
        return view('admin.associations.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::with('domaines')->findOrFail($id);
        return view('admin.associations.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $data = $request->except(['_token', '_method', 'domaine', 'domaine_autre']);
        $domaines = $this->normalizeDomaines($request->input('domaine', []), $request->input('domaine_autre'));

        $user->update($data);
        $user->syncDomainesByNames($domaines);

        AuditLog::record('association.update', "Association modifiée par admin: {$user->name}", ['user_id' => $user->id]);

        return redirect()->route('admin.dashboard')->with('success', 'Association mise à jour.');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        AuditLog::record('association.delete', "Association supprimée: {$user->name}", ['user_id' => $user->id]);
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Association supprimée.');
    }

    // --- Inscription par l'admin (3 étapes) ---
    public function createUserType1(StoreUserStep1Request $request)
    {
        $domaines = $this->normalizeDomaines($request->input('domaine', []), $request->input('domaine_autre'));

        $user = User::create([
            'groupe' => $request->groupe,
            'name' => $request->name,
            'denomination' => $request->denomination,
            'date' => $request->date,
            'objectifs' => $request->objectifs,
            'commune' => $request->commune,
            'arrondissement' => $request->arrondissement,
            'quartier' => $request->quartier,
            'maison' => $request->maison,
            'email' => $request->email,
            'number1' => $request->number1,
            'number2' => $request->number2,
            'lien' => $request->lien,
            'identifiant' => strtoupper(\Illuminate\Support\Str::random(8)),
            'password' => Hash::make(\Illuminate\Support\Str::random(16)),
        ]);

        $user->syncDomainesByNames($domaines);

        session(['admin_creating_user_id' => $user->id]);
        return redirect()->route('admin.createForm2');
    }

    public function createUserType2(StoreUserStep2Request $request)
    {
        $user = User::find(session('admin_creating_user_id'));
        if (!$user) return redirect()->back()->withErrors('Utilisateur introuvable.');

        if ($request->has('members')) {
            foreach ($request->members as $memberData) {
                $photoPath = null;
                if (isset($memberData['photo'])) {
                    $photoPath = $memberData['photo']->store('board_members', 'public');
                }
                
                $user->boardMembers()->create([
                    'role' => $memberData['role'],
                    'nom' => $memberData['nom'],
                    'prenom' => $memberData['prenom'],
                    'telephone' => $memberData['telephone'],
                    'photo_path' => $photoPath,
                ]);
            }
        }

        return redirect()->route('admin.createForm3');
    }

    public function createUserType3(StoreUserStep3Request $request)
    {
        $user = User::find(session('admin_creating_user_id'));
        if (!$user) return redirect()->back()->withErrors('Utilisateur introuvable.');

        $user->update([
            'logo_path' => $request->hasFile('logo') ? $request->file('logo')->store('attachments', 'public') : null,
            'recepisse_path' => $request->hasFile('doc_recepisse') ? $request->file('doc_recepisse')->store('attachments', 'public') : null,
            'journal_officiel_path' => $request->hasFile('doc_journal_officiel') ? $request->file('doc_journal_officiel')->store('attachments', 'public') : null,
            'attestation_path' => $request->hasFile('doc_attestation') ? $request->file('doc_attestation')->store('attachments', 'public') : null,
            'reglement_path' => $request->hasFile('doc_reglement') ? $request->file('doc_reglement')->store('attachments', 'public') : null,
            'created_by' => 'admin',
            'is_approved' => true,
        ]);

        AuditLog::record('association.create_admin', "Association créée par admin: {$user->name}", ['user_id' => $user->id]);

        session()->forget('admin_creating_user_id');
        return redirect()->route('admin.dashboard')->with('success', 'Association créée avec succès.');
    }

    private function normalizeDomaines(array $domaines, ?string $autre): array
    {
        return collect($domaines)
            ->map(fn ($domaine) => $domaine === 'Autre' && filled($autre) ? $autre : $domaine)
            ->reject(fn ($domaine) => $domaine === 'Autre')
            ->filter(fn ($domaine) => is_string($domaine) && trim($domaine) !== '')
            ->map(fn ($domaine) => trim($domaine))
            ->unique()
            ->values()
            ->all();
    }
}
