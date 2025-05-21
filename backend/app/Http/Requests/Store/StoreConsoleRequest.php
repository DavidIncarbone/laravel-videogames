<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreConsoleRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:consoles,name', 'min:2', 'max:20', 'regex:/^[a-zA-Z0-9\s\-\&\']+$/u'],
            'logo' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [

            // NAME

            'name.required' => 'Il campo nome è obbligatorio.',
            'name.string' => 'Il nome deve essere una stringa.',
            'name.min' => 'Il nome deve contenere almeno :min caratteri.',
            'name.unique' => 'Questo nome è già presente nel sistema',
            'name.max' => 'Il nome non può superare i :max caratteri.',
            'name.regex' => 'Il nome contiene caratteri non validi.',

            // LOGO

            'logo.required' => 'Il logo è obbligatorio',
            'logo.image' => 'Il file caricato deve essere un\'immagine.',
            'logo.mimes' => 'Sono ammessi solo file JPEG, PNG, JPG o WEBP.',
            'logo.max' => 'La dimensione massima dell\'immagine è di 2MB.',
        ];
    }
}
