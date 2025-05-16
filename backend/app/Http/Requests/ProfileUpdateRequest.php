<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }

     public function messages(): array
     {
         return[
              // NAME

             'name.required' => 'Il campo nome è obbligatorio.',
             'name.string' => 'Il nome deve essere una stringa.',
             'name.max' => 'Il nome non può superare i :max caratteri.',


            //  EMAIL

            'email.required' => 'Il campo email è obbligatorio.',
            'email.string' => 'L\'email deve essere una stringa.',
            'email.lowercase' => 'L\'email deve essere in lettere minuscole.',
            'email.email' => 'L\'email inserita non è valida.',
            'email.max' => 'L\'email non può superare i :max caratteri.',


         ];
     }
}
