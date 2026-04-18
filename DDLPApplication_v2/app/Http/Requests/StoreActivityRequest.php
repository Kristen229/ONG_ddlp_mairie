<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'lieu' => 'required|string',
            'date' => 'required|date',
            'attachment' => 'required|file|mimes:jpg,jpeg,png,pdf,docx',
            'beneficiaries_expected' => 'nullable|integer',
            'budget_expected' => 'nullable|numeric',
        ];
    }
}
