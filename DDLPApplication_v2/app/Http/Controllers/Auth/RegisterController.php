<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserStep1Request;
use App\Http\Requests\StoreUserStep2Request;
use App\Http\Requests\StoreUserStep3Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function createUserPartie1(StoreUserStep1Request $request)
    {
        $user = User::create([
            'group' => $request->groupe,
            'name' => $request->name,
            'domaine' => implode(',', $request->domaine),
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

        $path = $request->hasFile('attachment')
            ? $request->file('attachment')->store('attachments', 'public')
            : $user->attachment;

        $user->update([
            'siege' => $request->siege,
            'email' => $request->email,
            'number1' => $request->number1,
            'number2' => $request->number2,
            'attachment' => $path,
            'identifiant' => $request->identifiant,
            'password' => Hash::make($request->password),
            'lien' => $request->lien,
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
            'attachment1' => $request->hasFile('attachment1') ? $request->file('attachment1')->store('attachments', 'public') : 'attachments/user.jpg',
            'name_vice_president' => $request->name_vice_president,
            'last_name_vice_president' => $request->last_name_vice_president,
            'attachment2' => $request->hasFile('attachment2') ? $request->file('attachment2')->store('attachments', 'public') : 'attachments/user.jpg',
            'name_secretaire_general' => $request->name_secretaire_general,
            'last_name_secretaire_general' => $request->last_name_secretaire_general,
            'attachment3' => $request->hasFile('attachment3') ? $request->file('attachment3')->store('attachments', 'public') : 'attachments/user.jpg',
            'name_tresorier_general' => $request->name_tresorier_general,
            'last_name_tresorier_general' => $request->last_name_tresorier_general,
            'attachment4' => $request->hasFile('attachment4') ? $request->file('attachment4')->store('attachments', 'public') : 'attachments/user.jpg',
            'attachment5' => $request->file('attachment5')->store('attachments', 'public'),
            'signature_data' => $request->hasFile('signature_data') ? $request->file('signature_data')->store('attachments', 'public') : null,
            'cachet' => $request->hasFile('cachet') ? $request->file('cachet')->store('attachments', 'public') : null,
            'created_by' => 'user',
        ]);

        return redirect()->route('connexion');
    }
}
