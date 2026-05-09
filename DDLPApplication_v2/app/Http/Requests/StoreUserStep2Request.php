<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserStep2Request extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'siege' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number1' => 'required|string|max:20',
            'number2' => 'nullable|string|max:20',
        ];
    }
}
