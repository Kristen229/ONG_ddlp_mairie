<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserStep3Request extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name_president' => 'nullable|string|max:255',
            'last_name_president' => 'nullable|string|max:255',
            'attachment1' => 'nullable|image|max:2048',
            'name_vice_president' => 'nullable|string|max:255',
            'last_name_vice_president' => 'nullable|string|max:255',
            'attachment2' => 'nullable|image|max:2048',
            'name_secretaire_general' => 'nullable|string|max:255',
            'last_name_secretaire_general' => 'nullable|string|max:255',
            'attachment3' => 'nullable|image|max:2048',
            'name_tresorier_general' => 'nullable|string|max:255',
            'last_name_tresorier_general' => 'nullable|string|max:255',
            'attachment4' => 'nullable|image|max:2048',
            'attachment5' => 'required|image|max:2048',
            'signature_data' => 'nullable|image|max:2048',
            'cachet' => 'nullable|image|max:2048',
        ];
    }
}
