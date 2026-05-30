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
    public function index()
    {
        $requests = AssociationRequest::with('user')->orderBy('created_at', 'desc')->paginate(20);
        $pendingRequestsCount = AssociationRequest::where('statut', RequestStatus::PENDING)->count();
        return view('admin.requests.index', compact('requests', 'pendingRequestsCount'));
    }

    public function approve(Request $request, $id)
    {
        $assocRequest = AssociationRequest::findOrFail($id);
        
        $adminAttachmentPath = $assocRequest->admin_attachment;
        if ($request->hasFile('admin_attachment')) {
            $adminAttachmentPath = $request->file('admin_attachment')->store('courriers/responses', 'public');
        }

        $assocRequest->update([
            'statut' => RequestStatus::APPROVED,
            'admin_response' => $request->admin_response ?? $request->motif,
            'admin_attachment' => $adminAttachmentPath,
            'responded_at' => now(),
        ]);

        $user = $assocRequest->user;
        if ($user && $user->email) {
            Mail::to($user->email)->send(new RequestApproved($assocRequest, $request->admin_response ?? $request->motif));
        }

        return redirect()->route('admin.requests.index')->with('success', 'Courrier approuvé et réponse envoyée.');
    }

    public function reject(Request $request, $id)
    {
        $assocRequest = AssociationRequest::findOrFail($id);
        
        $adminAttachmentPath = $assocRequest->admin_attachment;
        if ($request->hasFile('admin_attachment')) {
            $adminAttachmentPath = $request->file('admin_attachment')->store('courriers/responses', 'public');
        }

        $assocRequest->update([
            'statut' => RequestStatus::REJECTED,
            'admin_response' => $request->admin_response ?? $request->motif,
            'admin_attachment' => $adminAttachmentPath,
            'responded_at' => now(),
        ]);

        $user = $assocRequest->user;
        if ($user && $user->email) {
            Mail::to($user->email)->send(new RequestRejected($assocRequest, $request->admin_response ?? $request->motif));
        }

        return redirect()->route('admin.requests.index')->with('success', 'Courrier rejeté et réponse envoyée.');
    }
}
