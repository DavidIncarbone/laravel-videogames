<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreScreenshotRequest extends FormRequest
{
    protected int $remainingCount;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->remainingCount = (int) $this->query('remainingCount');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
            'screenshots' => ['nullable', 'array', 'max:'.$this->remainingCount],

            'screenshots.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {

        $isScreenshot = $this->remainingCount > 1 ? 'screenshots' : 'screenshot';

        return [
            // Screenshots array

            'screenshots.array' => 'Il formato degli screenshot non è corretto',
            'screenshots.max' => 'Non puoi caricare più di :max '.$isScreenshot,

            // Screenshots immagini
            'screenshots.*.image' => 'Il file caricato deve essere un\'immagine.',
            'screenshots.*.mimes' => 'L\'immagine deve essere nei formati: jpeg, png, jpg o webp.',
            'screenshots.*.max' => 'L\'immagine non può superare i 2MB.',
        ];
    }
}
