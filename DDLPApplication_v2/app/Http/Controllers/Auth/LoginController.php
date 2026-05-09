<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'email' => 'Les informations de connexion ne correspondent pas.',
            ]);
        }

        if (!$user->is_approved) {
            return back()->withErrors([
                'email' => 'Votre candidature est en cours d\'examen par la Mairie. Vous recevrez un email une fois votre inscription validée.',
            ]);
        }

        Auth::login($user);

        if ($user->must_change_password) {
            return redirect()->route('password.change');
        }

        return redirect()->route('user.show', ['id' => $user->id]);
    }
}
