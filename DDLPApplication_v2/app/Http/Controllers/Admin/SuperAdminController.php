<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SuperAdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.super-admin.index', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
            'is_super_admin' => 'boolean',
        ]);

        $admin = Admin::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_super_admin' => $request->boolean('is_super_admin', false),
        ]);

        AuditLog::record('admin.create', "Administrateur créé: {$admin->email}", ['admin_id' => $admin->id]);

        return redirect()->route('admin.superadmin.index')->with('success', 'Administrateur créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $rules = [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('admins')->ignore($admin->id)],
            'is_super_admin' => 'boolean',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8';
        }

        $request->validate($rules);

        $isSuperAdmin = $admin->id === auth('admin')->id()
            ? $admin->is_super_admin
            : $request->boolean('is_super_admin', false);

        if ($admin->is_super_admin && !$isSuperAdmin && Admin::where('is_super_admin', true)->count() <= 1) {
            return back()->withErrors('Impossible de retirer le rôle du dernier super admin.');
        }

        $data = [
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'is_super_admin' => $isSuperAdmin,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        AuditLog::record('admin.update', "Administrateur modifié: {$admin->email}", ['admin_id' => $admin->id]);

        return redirect()->route('admin.superadmin.index')->with('success', 'Administrateur mis à jour.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        
        if ($admin->id === auth('admin')->id()) {
            return redirect()->back()->withErrors('Vous ne pouvez pas vous supprimer vous-même.');
        }

        if ($admin->is_super_admin && Admin::where('is_super_admin', true)->count() <= 1) {
            return redirect()->back()->withErrors('Impossible de supprimer le dernier super admin.');
        }

        AuditLog::record('admin.delete', "Administrateur supprimé: {$admin->email}", ['admin_id' => $admin->id]);

        $admin->delete();

        return redirect()->route('admin.superadmin.index')->with('success', 'Administrateur supprimé.');
    }
}
