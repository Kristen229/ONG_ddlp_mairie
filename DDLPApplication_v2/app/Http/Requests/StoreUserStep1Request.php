<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserStep1Request extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'groupe' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'domaine' => 'required|array',
            'denomination' => 'required|string|max:255',
            'date' => 'required|date',
            'objectif1' => 'required|string|max:255',
            'objectif2' => 'required|string|max:255',
            'objectif3' => 'required|string|max:255',
        ];
    }
}
