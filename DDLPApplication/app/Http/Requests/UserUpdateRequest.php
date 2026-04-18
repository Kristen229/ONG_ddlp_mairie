<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // middleware handled
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'signature_data' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cachet' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // On peut ajouter d'autres champs si besoin
        ];
    }
}
