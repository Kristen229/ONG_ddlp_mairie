<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Notification;
use App\Models\Activity;
use App\Models\Requests;

use Illuminate\Http\Request as HttpRequest;
use setasign\Fpdi\Fpdi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function showPage($id)
    {
        $user = User::findOrFail($id);  // Fetch the user by ID
        $notifications = Notification::all();  // Fetch notifications (replace with your actual query)
  $activities = Activity::where('user_id', $user->id)
        ->latest()
        ->get();
        return view('user.show', compact('user', 'notifications', 'activities'));
    }

    // 🌟 1️⃣ Soumission classique (sans PDF)
    public function handleRequest(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|string',
            'location'    => 'required|string|max:255',
            'description' => 'required|string',
            'destinataire'=> 'required|in:Maire de la Commune de Cotonou,Secretaire exécutif',
            'reference'=> 'require|string',

        ]);

        $user = Auth::user();

        $soumission = Requests::create([
            'user_id'     => $user->id,
            'title'       => $data['title'],
            'type'        => $data['type'],
            'location'    => $data['location'],
            'description' => $data['description'],
            'statut'      => 'En attente',
            'destinataire'=> 'required|in:Maire de la Commune de Cotonou,Secretaire exécutif',
            'reference'=>$data['reference'],

        ]);

        return back()->with('success', 'Demande enregistrée avec succès !');
    }

    public function store(Request $request)
    {
        // 1️⃣ Validation
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|string',
            'location'    => 'required|string|max:255',
            'description' => 'required|string',
            'destinataire'=> 'required|in:Maire de la Commune de Cotonou,Secretaire exécutif',
            'reference'=> 'required|string',

        ]);

        // 2️⃣ Utilisateur connecté
        $user = Auth::user();

        $logo = $user->attachment
            ? storage_path('app/public/attachments/' . $user->attachment)
            : null;

        $cover = $user->attachment5
            ? storage_path('app/public/attachments/' . $user->attachment5)
            : null;

        $signature = $user->signature
            ? storage_path('app/public/attachments/' . $user->signature_data)
            : null;

        $cachet = $user->cachet
            ? storage_path('app/public/attachments/' . $user->cachet)
            : null;

        // 4️⃣ Génération du PDF
        $pdf = Pdf::loadView('pdf.courrier', [
            'data'      => $data,
            'date'      => now()->format('d/m/Y'),
            'user'      => $user,
            'logo'      => $logo,
            'cover'     => $cover,
            'signature' => $signature,
            'cachet'    => $cachet,
        ]);


        // 5️⃣ Stockage du PDF
        $filename = 'courrier_' . time() . '.pdf';
        $pdfPath = 'courriers/' . $filename;

        if (!Storage::disk('public')->exists('courriers')) {
            Storage::disk('public')->makeDirectory('courriers');
        }

        $pdf->save(storage_path('app/public/' . $pdfPath));

        // 6️⃣ Enregistrer la demande
        $soumission = Requests::create([
            'user_id'     => $user->id,
            'title'       => $data['title'],
            'type'        => $data['type'],
            'location'    => $data['location'],
            'description' => $data['description'],
            'pdf_path'    => $pdfPath,
            'statut'      => 'en_attente',
        ]);

        // 7️⃣ Page de confirmation
        return view('courrier.generated', [
            'soumission' => $soumission,
            'pdfUrl'     => asset('storage/' . $pdfPath),
        ]);
    }

    public function showDetails($id)
    {
        $request = Requests::with('user')->find($id);

        if (!$request) {
            return response()->json(['error' => 'Demande non trouvée'], 404);
        }

        return response()->json([
            'user' => [
                'name' => $request->user->name,
            ],
            'type' => $request->type,
            'description' => $request->description,
            'created_at' => $request->created_at->format('d/m/Y H:i'),
            'statut' => $request->statut,
            'pdf_path' => asset('storage/' . $request->pdf_path),
        ]);
    }

    public function show($id)
    {
        $request = Requests::with('user')->find($id);
        if (!$request) {
            return response()->json(['error' => 'Demande non trouvée'], 404);
        }
        return response()->json($request);
    }

}
