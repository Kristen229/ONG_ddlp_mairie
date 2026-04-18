<?php
namespace App\Http\Controllers;

use App\Models\AssociationRequest;
use App\Http\Requests\StoreAssociationRequestRequest;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AssociationRequestController extends Controller
{
    public function store(StoreAssociationRequestRequest $request)
    {
        $assocRequest = AssociationRequest::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'type' => $request->type,
            'description' => $request->description,
            'location' => $request->location,
            'destinataire' => $request->destinataire,
            'reference' => $request->reference,
        ]);

        $user = Auth::user();
        $pdf = Pdf::loadView('pdf.courrier', compact('assocRequest', 'user'));
        $pdfPath = 'courriers/courrier_' . $assocRequest->id . '.pdf';
        \Storage::disk('public')->put($pdfPath, $pdf->output());

        $assocRequest->update(['pdf_path' => $pdfPath]);

        return redirect()->back()->with('success', 'Demande soumise avec succès.');
    }

    public function handleRequest(StoreAssociationRequestRequest $request)
    {
        return $this->store($request);
    }

    public function show($id)
    {
        $assocRequest = AssociationRequest::with('user')->findOrFail($id);
        return view('admin.requests.show', compact('assocRequest'));
    }
}
