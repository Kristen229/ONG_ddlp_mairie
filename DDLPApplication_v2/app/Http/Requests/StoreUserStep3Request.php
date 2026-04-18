<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserStep3Request extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name_president' => 'required|string|max:255',
            'last_name_president' => 'required|string|max:255',
            'name_vice_president' => 'nullable|string|max:255',
            'last_name_vice_president' => 'nullable|string|max:255',
            'name_secretaire_general' => 'nullable|string|max:255',
            'last_name_secretaire_general' => 'nullable|string|max:255',
            'name_tresorier_general' => 'nullable|string|max:255',
            'last_name_tresorier_general' => 'nullable|string|max:255',
            'attachment' => 'required|file|mimes:pdf|max:5048',
            'attachment1' => 'required|file|mimes:pdf|max:5048',
            'attachment2' => 'required|file|mimes:pdf|max:5048',
            'attachment3' => 'required|file|mimes:pdf|max:5048',
            'attachment5' => 'required|image|max:2048',
            'lien' => 'nullable|url|max:255',
        ];
    }
}
