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
            'lieu' => 'required|string|max:255',
            'date' => 'required|date',
            'attachment' => 'nullable|image|max:20480',
            'beneficiaries_expected' => 'required|integer|min:1',
            'budget_expected' => 'required|numeric|min:0',
            'target_audience' => 'required|string|max:255',
        ];
    }
}
