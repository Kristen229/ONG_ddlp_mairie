<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ApproveRejectRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'motif' => 'required|string',
            'email' => 'required|email',
            'attachment' => 'nullable|file|mimes:pdf|max:2048',
        ];
    }
}
