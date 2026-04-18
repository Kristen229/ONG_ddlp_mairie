<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserStep1Request;
use App\Http\Requests\StoreUserStep2Request;
use App\Http\Requests\StoreUserStep3Request;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AssociationController extends Controller
{
    public function showPage($id)
    {
        $user = User::findOrFail($id);
        return view('admin.associations.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.associations.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->except(['_token', '_method']));
        return redirect()->route('admin.dashboard')->with('success', 'Association mise à jour.');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Association supprimée.');
    }

    // --- Inscription par l'admin (3 étapes) ---
    public function createUserType1(StoreUserStep1Request $request)
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

        session(['admin_creating_user_id' => $user->id]);
        return redirect()->route('admin.createForm2');
    }

    public function createUserType2(StoreUserStep2Request $request)
    {
        $user = User::find(session('admin_creating_user_id'));
        if (!$user) return redirect()->back()->withErrors('Utilisateur introuvable.');

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

        return redirect()->route('admin.createForm3');
    }

    public function createUserType3(StoreUserStep3Request $request)
    {
        $user = User::find(session('admin_creating_user_id'));
        if (!$user) return redirect()->back()->withErrors('Utilisateur introuvable.');

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
            'created_by' => 'admin',
        ]);

        session()->forget('admin_creating_user_id');
        return redirect()->route('admin.dashboard')->with('success', 'Association créée avec succès.');
    }
}
