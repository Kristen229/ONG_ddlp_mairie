<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserStep3Request extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $isAdmin = request()->routeIs('admin.*');

        return [
            'logo' => $isAdmin ? 'nullable|image|max:20480' : 'required|image|max:20480',
            'doc_recepisse' => 'required|file|mimes:pdf|max:20480',
            'doc_journal_officiel' => 'required|file|mimes:pdf|max:20480',
            'doc_attestation' => 'required|file|mimes:pdf|max:20480',
            'doc_reglement' => 'required|file|mimes:pdf|max:20480',
        ];
    }
}
