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
            'domaine.*' => 'string|max:255',
            'domaine_autre' => 'nullable|string|max:255',
            'denomination' => 'required|string|max:255',
            'date' => 'required|date',
            'objectifs' => 'required|array|min:5|max:5',
            'objectifs.*' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'arrondissement' => 'required|string|max:255',
            'quartier' => 'required|string|max:255',
            'maison' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'number1' => 'required|string|regex:/^01[0-9]{8}$/',
            'number2' => 'nullable|string|regex:/^01[0-9]{8}$/',
            'lien' => 'nullable|url|max:255',
        ];
    }
}
