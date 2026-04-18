<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreAssociationRequestRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'type' => 'required|string',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'destinataire' => 'required|in:Maire de la Commune de Cotonou,Secretaire exécutif',
            'reference' => 'required|string',
        ];
    }
}
