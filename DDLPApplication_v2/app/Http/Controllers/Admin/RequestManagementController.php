<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssociationRequest;
use App\Models\AuditLog;
use App\Models\Notification;
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
        $validated = $request->validate([
            'admin_response' => ['required', 'string', 'max:5000'],
            'admin_attachment' => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
        ]);

        $assocRequest = AssociationRequest::findOrFail($id);
        $response = $validated['admin_response'];
        
        $adminAttachmentPath = $assocRequest->admin_attachment;
        if ($request->hasFile('admin_attachment')) {
            $adminAttachmentPath = $request->file('admin_attachment')->store('courriers/responses', 'public');
        }

        $assocRequest->update([
            'statut' => RequestStatus::APPROVED,
            'admin_response' => $response,
            'admin_attachment' => $adminAttachmentPath,
            'responded_at' => now(),
        ]);

        $user = $assocRequest->user;
        if ($user && $user->email) {
            Mail::to($user->email)->send(new RequestApproved($assocRequest, $response));
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Mail envoye par la mairie',
                'message' => "Un email concernant votre courrier '{$assocRequest->objet}' vient de vous etre envoye. Consultez votre boite mail.",
                'recipient_name' => $user->name,
                'recipient_email' => $user->email,
            ]);
        }

        AuditLog::record('request.approve', "Courrier approuvé: {$assocRequest->objet}", ['request_id' => $assocRequest->id, 'user_id' => $user?->id]);

        return redirect()->route('admin.requests.index')->with('success', 'Courrier approuvé et réponse envoyée.');
    }

    public function reject(Request $request, $id)
    {
        $validated = $request->validate([
            'admin_response' => ['required', 'string', 'max:5000'],
            'admin_attachment' => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
        ]);

        $assocRequest = AssociationRequest::findOrFail($id);
        $response = $validated['admin_response'];
        
        $adminAttachmentPath = $assocRequest->admin_attachment;
        if ($request->hasFile('admin_attachment')) {
            $adminAttachmentPath = $request->file('admin_attachment')->store('courriers/responses', 'public');
        }

        $assocRequest->update([
            'statut' => RequestStatus::REJECTED,
            'admin_response' => $response,
            'admin_attachment' => $adminAttachmentPath,
            'responded_at' => now(),
        ]);

        $user = $assocRequest->user;
        if ($user && $user->email) {
            Mail::to($user->email)->send(new RequestRejected($assocRequest, $response));
            Notification::create([
                'user_id' => $user->id,
                'title' => 'Mail envoye par la mairie',
                'message' => "Un email concernant votre courrier '{$assocRequest->objet}' vient de vous etre envoye. Consultez votre boite mail.",
                'recipient_name' => $user->name,
                'recipient_email' => $user->email,
            ]);
        }

        AuditLog::record('request.reject', "Courrier rejeté: {$assocRequest->objet}", ['request_id' => $assocRequest->id, 'user_id' => $user?->id]);

        return redirect()->route('admin.requests.index')->with('success', 'Courrier rejeté et réponse envoyée.');
    }
}
