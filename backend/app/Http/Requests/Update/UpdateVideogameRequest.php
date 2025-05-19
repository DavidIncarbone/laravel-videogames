<?php

namespace App\Http\Requests\Update;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideogameRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:1', 'max:50'],

            'console_ids' => ['required', 'array', 'exists:consoles,id'],

            'genre_ids' => ['required', 'array', 'min:1', 'exists:genres,id'],

            'publisher' => ['required', 'string', 'min:2', 'max:50'],

            'year_of_publication' => ['required', 'integer', 'between:1970,' . date('Y')],

            'price' => ['required', 'numeric', 'min:0.01'],

            'pegi_id' => ['required', 'exists:pegis,id'],

            'description' => ['required', 'string', 'min:10', 'max:255'],

            'cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],

            'screenshots' => ['nullable', 'array', 'max:4'],

            'screenshots.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            // Name
            'name.required' => 'Il campo nome del videogioco è obbligatorio.',
            'name.string' => 'Il nome del videogioco deve essere una stringa.',
            'name.min' => 'Il nome del videogioco deve contenere almeno :min caratteri.',
            'name.max' => 'Il nome del videogioco non può superare i :max caratteri.',

            // Console
            'console_ids.required' => 'Seleziona almeno una console.',
            'console_ids.array' => 'Il formato delle console non è corretto.',
            'console_ids.min' => 'Seleziona almeno una console.',
            'console_ids.*.exists' => 'Una o più console selezionate non sono valide.',

            // Generi
            'genre_ids.required' => 'Seleziona almeno un genere.',
            'genre_ids.array' => 'Il formato dei generi non è corretto.',
            'genre_ids.min' => 'Seleziona almeno un genere.',
            'genre_ids.*.exists' => 'Uno o più generi selezionati non sono validi.',

            // Publisher
            'publisher.required' => 'Il campo casa produttrice è obbligatorio.',
            'publisher.string' => 'La casa produttrice deve essere una stringa.',
            'publisher.min' => 'La casa produttrice deve contenere almeno :min caratteri.',
            'publisher.max' => 'La casa produttrice non può superare i :max caratteri.',

            // Anno
            'year_of_publication.required' => 'L\'anno di pubblicazione è obbligatorio.',
            'year_of_publication.integer' => 'L\'anno di pubblicazione deve essere un numero.',
            'year_of_publication.between' => 'Anno non compreso tra 1970 - Anno attuale.',

            // Prezzo
            'price.required' => 'Il prezzo è obbligatorio.',
            'price.numeric' => 'Il prezzo deve essere un numero.',
            'price.min' => 'Il prezzo non può essere negativo.',

            // PEGI
            'pegi_id.required' => 'Seleziona un\' età minima.',
            'pegi_id.exists' => 'L\' età minima selezionata non è vailda.',

            // Descrizione
            'description.required' => 'La descrizione è obbligatoria.',
            'description.string' => 'La descrizione deve essere una stringa.',
            'description.min' => 'La descrizione deve contenere almeno :min caratteri.',
            'description.max' => 'La descrizione non può superare i :max caratteri.',

            // Copertina

            'cover.image' => 'Il file caricato deve essere un\'immagine.',
            'cover.mimes' => 'L\'immagine deve essere nei formati: jpeg, png, jpg o webp.',
            'cover.max' => 'L\'immagine non può superare i 2MB.',

            // Screenshots array

            'screenshots.array' => 'Il formato degli screenshot non è corretto',
            'screenshots.max' => 'Non puoi caricare più di :max screenshots',

            // Screenshots immagini
            'screenshots.*.image' => 'Il file caricato deve essere un\'immagine.',
            'screenshots.*.mimes' => 'L\'immagine deve essere nei formati: jpeg, png, jpg o webp.',
            'screenshots.*.max' => 'L\'immagine non può superare i 2MB.',
        ];
    }
}
