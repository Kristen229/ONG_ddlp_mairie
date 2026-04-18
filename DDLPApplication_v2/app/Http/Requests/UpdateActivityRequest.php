<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UpdateActivityRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment' => 'nullable|image|max:2048',
            'beneficiaries_actual' => 'required|integer',
            'budget_actual' => 'required|numeric',
            'actual_date' => 'required|date',
        ];
    }
}
