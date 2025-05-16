<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePegiRequest extends FormRequest
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
        return [
            'age' => [ 'required',
            'numeric',
            'min:1',
            'max:100',
    ],
                   
            'logo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'];
    }

    public function messages(): array
    {
        return  [
        
             // Age

        
            'age.required' => 'Il campo età è obbligatorio.',
            'age.numeric' => 'Il campo età deve essere un numero.',
            'age.min' => 'L\'età minima non può essere inferiore ad :min anno.',
            'age.max' => 'L\'età massima non può essere superiore a :max anni.',


            // Logo


            'logo.required' => 'Il logo è obbligatorio',
            'logo.image' => 'Il file caricato deve essere un\'immagine.',
            'logo.mimes' => 'Sono ammessi solo file JPEG, PNG, JPG o WEBP.',
            'logo.max' => 'La dimensione massima dell\'immagine è di 2MB.',
        ];
    }
}
