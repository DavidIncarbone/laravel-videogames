<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScreenshotRequest extends FormRequest
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
            'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'screenshot.image' => 'Il file caricato deve essere un\'immagine.',
            'screenshot.mimes' => 'Sono ammessi solo file JPEG, PNG, JPG o WEBP.',
            'screenshot.max' => 'La dimensione massima dell\'immagine è di 2MB.',
        ];
    }
}
