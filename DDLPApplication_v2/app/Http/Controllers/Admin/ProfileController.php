<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit', ['admin' => auth('admin')->user()]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password:admin'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $admin = auth('admin')->user();
        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        AuditLog::record('admin.profile_password_update', "Mot de passe admin modifié: {$admin->email}", ['admin_id' => $admin->id]);

        return back()->with('success', 'Mot de passe admin mis à jour.');
    }
}
