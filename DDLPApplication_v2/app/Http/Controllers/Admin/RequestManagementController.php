<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssociationRequest;
use App\Enums\RequestStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RequestApproved;
use App\Mail\RequestRejected;

class RequestManagementController extends Controller
{
    public function approve(Request $request, $id)
    {
        $assocRequest = AssociationRequest::findOrFail($id);
        $assocRequest->update(['statut' => RequestStatus::APPROVED]);

        if ($request->hasFile('attachment')) {
            $pdfPath = $request->file('attachment')->store('courriers', 'public');
            $assocRequest->update(['pdf_path' => $pdfPath]);
        }

        $user = $assocRequest->user;
        if ($user && $user->email) {
            Mail::to($user->email)->send(new RequestApproved($assocRequest, $request->motif));
        }

        return redirect()->route('admin.dashboard')->with('success', 'Demande approuvée.');
    }

    public function reject(Request $request, $id)
    {
        $assocRequest = AssociationRequest::findOrFail($id);
        $assocRequest->update(['statut' => RequestStatus::REJECTED]);

        $user = $assocRequest->user;
        if ($user && $user->email) {
            Mail::to($user->email)->send(new RequestRejected($assocRequest, $request->motif));
        }

        return redirect()->route('admin.dashboard')->with('success', 'Demande rejetée.');
    }
}
