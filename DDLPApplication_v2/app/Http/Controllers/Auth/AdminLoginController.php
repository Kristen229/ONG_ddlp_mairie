<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard', ['id' => $admin->id]);
        }

        return back()->withErrors([
            'email' => 'Les informations de connexion ne correspondent pas.',
        ]);
    }

    public function createAdmin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:5',
        ]);

        Admin::create([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        return redirect()->route('conAdmin')->with('success', 'Vous avez été enregistré avec succès!');
    }
}
