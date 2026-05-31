<?php
namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showAssociations()
    {
        $users = User::where('is_approved', true)
            ->with(['domaines', 'activities.user.domaines'])
            ->get();

        $latestReviews = \App\Models\Review::with(['user', 'activity'])
            ->where('is_approved', true)
            ->latest()
            ->take(6)
            ->get();
        return view('pages.accueil', compact('users', 'latestReviews'));
    }

    public function indexe(Request $request)
    {
        $query = User::where('is_approved', true);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('domaine')) {
            $query->whereHas('domaines', fn ($domaine) => $domaine->where('nom', $request->domaine));
        }

        $query->with('domaines');
        $users = $query->paginate(12)->appends($request->query());

        // Récupérer tous les domaines uniques des assos approuvées pour le filtre
        $domaines = Domaine::whereHas('users', fn ($user) => $user->where('is_approved', true))
            ->orderBy('nom')
            ->pluck('nom');

        return view('pages.association-et-ong', compact('users', 'domaines'));
    }

    public function showDetails($id)
    {
        $user = User::where('is_approved', true)->with(['domaines', 'activities' => function($query) {
            $query->where('is_visible', true);
        }, 'reviews' => function ($query) {
            $query->where('is_approved', true)->latest();
        }])->findOrFail($id);
        return view('pages.association-details', compact('user'));
    }

    public function shows($id)
    {
        abort_unless((int) $id === Auth::id(), 403);

        $user = User::with(['domaines', 'activities', 'requests', 'notifications', 'boardMembers'])->findOrFail($id);
        return view('user.show', compact('user'));
    }

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

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('user.show', ['id' => $user->id]);
        }

        return back()->withErrors(['email' => 'Les informations de connexion ne correspondent pas.']);
    }

    public function showAdminPage()
    {
        return redirect()->route('admin.dashboard');
    }

    public function update(Request $request, $id)
    {
        abort_unless((int) $id === Auth::id(), 403);

        $user = User::findOrFail($id);
        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $user->update($data);
        return redirect()->route('user.show', ['id' => $user->id])->with('success', 'Profil mis à jour.');
    }

    public function updateInfos(Request $request, $id)
    {
        abort_unless((int) $id === Auth::id(), 403);

        $user = User::findOrFail($id);
        $data = $request->except(['_token', '_method']);
        $user->update($data);
        return redirect()->route('user.show', ['id' => $user->id])->with('success', 'Informations mises à jour.');
    }
}
