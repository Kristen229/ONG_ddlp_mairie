<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
        ];

        if ($this->isMethod('post')) {
            // Création d'activité standard ou admin
            $rules['attachment'] = 'required|file|max:2048';
            $rules['lieu'] = 'required|string|max:255';
            $rules['date'] = 'required'; // Parfois string dans storeAdmin, parfois date dans store
            
            if ($this->has('user_id')) { // cas storeAdmin
                $rules['user_id'] = 'required|exists:users,id';
            }
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            // Modification d'activité
            $rules['attachment'] = 'nullable|image|max:2048';
            $rules['beneficiaries_actual'] = 'required|integer';
            $rules['budget_actual'] = 'required|numeric';
            $rules['actual_date'] = 'required|date';
        }

        return $rules;
    }
}
