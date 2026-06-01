<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserStep1Request;
use App\Http\Requests\StoreUserStep2Request;
use App\Http\Requests\StoreUserStep3Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function createUserPartie1(StoreUserStep1Request $request)
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
            'identifiant' => strtoupper(Str::random(8)), // Temporaire avant génération finale
            'password' => Hash::make(Str::random(16)),
        ]);

        $user->syncDomainesByNames($domaines);

        session(['user_id' => $user->id]);
        return redirect()->route('user.createForme2');
    }

    public function createUserPartie2(StoreUserStep2Request $request)
    {
        $userId = session('user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->back()->withErrors('Utilisateur introuvable.');
        }

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

        return redirect()->route('user.createForme3')->with('success', 'Bureau enregistré.');
    }

    public function createUserPartie3(StoreUserStep3Request $request)
    {
        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()->back()->withErrors('Utilisateur introuvable.');
        }

        $user->update([
            'logo_path' => $request->hasFile('logo') ? $request->file('logo')->store('attachments', 'public') : null,
            'recepisse_path' => $request->hasFile('doc_recepisse') ? $request->file('doc_recepisse')->store('attachments', 'public') : null,
            'journal_officiel_path' => $request->hasFile('doc_journal_officiel') ? $request->file('doc_journal_officiel')->store('attachments', 'public') : null,
            'attestation_path' => $request->hasFile('doc_attestation') ? $request->file('doc_attestation')->store('attachments', 'public') : null,
            'reglement_path' => $request->hasFile('doc_reglement') ? $request->file('doc_reglement')->store('attachments', 'public') : null,
            'created_by' => 'user',
            'is_approved' => false,
        ]);

        // Nettoyer la session une fois terminé
        session()->forget('user_id');

        return redirect()->route('inscription.confirmation')->with('success', 'Inscription finalisée. En attente de validation.');
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
