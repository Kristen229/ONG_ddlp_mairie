<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreAssociationRequestRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'objet' => 'required|string|max:255',
            'attachment' => 'required|file|mimes:pdf|max:20480',
        ];
    }
}
