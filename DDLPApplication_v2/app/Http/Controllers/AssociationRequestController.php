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
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('courriers', 'public');
        }

        $assocRequest = AssociationRequest::create([
            'user_id' => Auth::id(),
            'objet' => $request->objet,
            'title' => $request->objet, // keep title for backward compatibility if needed, or remove if not used elsewhere
            'type' => 'Courrier',
            'attachment' => $attachmentPath,
        ]);

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
