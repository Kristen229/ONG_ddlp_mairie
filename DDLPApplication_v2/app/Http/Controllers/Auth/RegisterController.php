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
        $user = User::create([
            'groupe' => $request->group,
            'name' => $request->name,
            'domaine' => $request->domaine,
            'denomination' => $request->denomination,
            'date' => $request->date,
            'objectif1' => $request->objectif1,
            'objectif2' => $request->objectif2,
            'objectif3' => $request->objectif3,
        ]);

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

        $user->update([
            'siege' => $request->siege,
            'email' => $request->email,
            'number1' => $request->number1,
            'number2' => $request->number2,
            'password' => Hash::make(Str::random(16)), // Mot de passe temporaire (sera remplacé à l'approbation)
        ]);

        return redirect()->route('user.createForme3')->with('success', 'Formulaire 2 enregistré.');
    }

    public function createUserPartie3(StoreUserStep3Request $request)
    {
        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()->back()->withErrors('Utilisateur introuvable.');
        }

        $user->update([
            'name_president' => $request->name_president,
            'last_name_president' => $request->last_name_president,
            'name_vice_president' => $request->name_vice_president,
            'last_name_vice_president' => $request->last_name_vice_president,
            'name_secretaire_general' => $request->name_secretaire_general,
            'last_name_secretaire_general' => $request->last_name_secretaire_general,
            'name_tresorier_general' => $request->name_tresorier_general,
            'last_name_tresorier_general' => $request->last_name_tresorier_general,
            'attachment' => $request->hasFile('attachment') ? $request->file('attachment')->store('attachments', 'public') : null,
            'attachment1' => $request->hasFile('attachment1') ? $request->file('attachment1')->store('attachments', 'public') : null,
            'attachment2' => $request->hasFile('attachment2') ? $request->file('attachment2')->store('attachments', 'public') : null,
            'attachment3' => $request->hasFile('attachment3') ? $request->file('attachment3')->store('attachments', 'public') : null,
            'attachment5' => $request->hasFile('attachment5') ? $request->file('attachment5')->store('attachments', 'public') : null,
            'lien' => $request->lien,
            'created_by' => 'user',
            'is_approved' => false,
        ]);

        session()->forget('user_id');
        return redirect()->route('inscription.confirmation');
    }
}
