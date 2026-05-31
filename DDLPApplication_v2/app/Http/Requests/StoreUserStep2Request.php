<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserStep2Request extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $isAdmin = request()->routeIs('admin.*');

        return [
            'members' => 'required|array|min:3',
            'members.*.role' => 'required|string|max:255',
            'members.*.nom' => 'required|string|max:255',
            'members.*.prenom' => 'required|string|max:255',
            'members.*.telephone' => 'required|string|max:255',
            'members.*.photo' => $isAdmin ? 'nullable|image|max:20480' : 'required|image|max:20480',
        ];
    }
}
