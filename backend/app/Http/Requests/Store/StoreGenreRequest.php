<?php

namespace App\Http\Requests\Store;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenreRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:2',
                'max:15',
                'regex:/^[a-zA-Z0-9\s\-\&\']+$/u',

            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.string' => 'Il campo nome deve essere una stringa.',
            'name.min' => 'Il campo nome deve contenere almeno :min caratteri.',
            'name.max' => 'Il campo nome non può superare i :max caratteri.',
            'name.regex' => 'Il campo nome contiene caratteri non validi.',
        ];
    }
}
