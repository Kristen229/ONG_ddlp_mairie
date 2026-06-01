<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
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
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',
            'is_super_admin' => 'boolean',
        ]);

        Admin::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_super_admin' => $request->boolean('is_super_admin', false),
        ]);

        return redirect()->route('admin.superadmin.index')->with('success', 'Administrateur créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $rules = [
            'email' => ['required', 'email', Rule::unique('admins')->ignore($admin->id)],
            'is_super_admin' => 'boolean',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8';
        }

        $request->validate($rules);

        $data = [
            'email' => $request->email,
            'is_super_admin' => $request->boolean('is_super_admin', false),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.superadmin.index')->with('success', 'Administrateur mis à jour.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        
        if ($admin->id === auth('admin')->id()) {
            return redirect()->back()->withErrors('Vous ne pouvez pas vous supprimer vous-même.');
        }

        $admin->delete();

        return redirect()->route('admin.superadmin.index')->with('success', 'Administrateur supprimé.');
    }
}
