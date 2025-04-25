<?php

namespace App\Http\Controllers\Admin\Videogames;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Videogame;
use App\Models\Console;
use App\Models\Genre;
use App\Models\Pegi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideogameController extends Controller
{

    public function index(Request $request)
    {

        $query = Videogame::query();


        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        };
        if ($request->orderFor == "create" && $request->orderBy == "desc") {
            $query->orderBy("created_at", "desc");
        } else if ($request->orderFor == "edit" && $request->orderBy == "asc") {
            $query->orderBy("updated_at");
        } else if ($request->orderFor == "edit" && $request->orderBy == "desc") {
            $query->orderBy("updated_at", "desc");
        }

        $videogames = $query->paginate(5)->withQueryString();
        return view("videogames.index", compact("videogames"));
    }


    public function create()
    {
        $consoles = Console::all();
        $genres = Genre::all();
        $pegis = Pegi::all();

        return view("videogames.create", compact("consoles", "genres", "pegis"));
    }


    public function store(Request $request)

    {


        // VALIDATION

        $request->validate([

            'name' => ['required', 'string', 'min:2', 'max:50'],

            'console_ids' => ['required', 'array', 'exists:consoles,id'],

            'genre_ids' => ['required', 'array', 'min:1', 'exists:genres,id'],

            'publisher' => ['required', 'string', 'min:2', 'max:50'],

            'year_of_publication' => ['required', 'integer', 'between:1970,' . date('Y')],

            'price' => ['required', 'numeric', 'min:0.01'],

            'pegi_id' => ['required', 'exists:pegis,id'],

            'description' => ['required', 'string', 'min:10', 'max:255'],

            'cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
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
        ]);

        // DATABASE

        $data = $request->all();
        $newVideogame = new Videogame();



        $newVideogame->pegi_id = $data["pegi_id"];
        $newVideogame->name = Str::of($data["name"])->trim();
        $newVideogame->price = $data["price"];
        $newVideogame->console_ids = $data["console_ids"];
        $newVideogame->genre_ids = $data["genre_ids"];
        $newVideogame->publisher = Str::of($data["publisher"])->trim();
        $newVideogame->year_of_publication = $data["year_of_publication"];
        $newVideogame->description = Str::of($data["description"])->trim();

        if (array_key_exists("cover", $data)) {
            $cover_url = Storage::putFile("videogames", $data["cover"]);
            $newVideogame->cover = $cover_url;
        }

        $newVideogame->save();

        if ($request->has("genre_ids")) {
            $newVideogame->genres()->attach($data["genre_ids"]);
        }
        if ($request->has("console_ids")) {
            $newVideogame->consoles()->attach($data["console_ids"]);
        }

        toastr()->success("<span class='fw-bold'>" . Str::limit($newVideogame->name, 20) . '</span> è stato aggiunto con successo');
        return redirect()->route("admin.videogames.show", $newVideogame);
    }

    /**
     * Display the specified resource.
     */
    public function show(videogame $videogame)


    {
        return view("videogames.show", compact("videogame"));
    }


    public function edit(videogame $videogame)
    {
        $consoles = Console::all();
        $genres = Genre::all();
        $pegis = Pegi::all();
        // $videogame->genre_ids = $videogame->genres->pluck('id')->toArray();
        return view("videogames.edit", compact("videogame", "consoles", "genres", "pegis"));
    }


    public function update(Request $request, Videogame $videogame)
    {

        // ADD THIS ARRAYS ANYWAY

        $request->merge([
            'genre_ids' => $request->input('genre_ids', []),
            'console_ids' => $request->input('console_ids', [])
        ]);

        // VALIDATION

        $request->validate([

            'name' => ['required', 'string', 'min:1', 'max:50'],

            'console_ids' => ['required', 'array', 'exists:consoles,id'],

            'genre_ids' => ['required', 'array', 'min:1', 'exists:genres,id'],

            'publisher' => ['required', 'string', 'min:2', 'max:50'],

            'year_of_publication' => ['required', 'integer', 'between:1970,' . date('Y')],

            'price' => ['required', 'numeric', 'min:0.01'],

            'pegi_id' => ['required', 'exists:pegis,id'],

            'description' => ['required', 'string', 'min:10', 'max:255'],

            'cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
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
        ]);

        // SAVE TO DB

        $data = $request->all();


        $videogame->pegi_id = $data["pegi_id"];
        $videogame->name = $data["name"];
        $videogame->publisher = $data["publisher"];
        $videogame->year_of_publication = $data["year_of_publication"];
        $videogame->description = $data["description"];


        if (array_key_exists("cover", $data)) {

            $cover_url = Storage::putFile("videogames", $data["cover"]);
            $updateData["cover"] = $cover_url;
        }



        // NO CHANGE EVENTUALITY

        $originalConsoleIds = $videogame->consoles->pluck("id")->sort()->values()->toArray();
        $originalGenreIds = $videogame->genres->pluck("id")->sort()->values()->toArray();

        $newConsoleIds = collect($data["console_ids"])->map(fn($id) => (int) $id)->sort()->values()->toArray();
        $newGenreIds = collect($data["genre_ids"])->map(fn($id) => (int) $id)->sort()->values()->toArray();

        $videogameUnchanged = $videogame->isClean();
        $consoleUnchanged = $originalConsoleIds === $newConsoleIds;
        $genreUnchanged = $originalGenreIds === $newGenreIds;

        // TOASTR

        if ($videogameUnchanged && $consoleUnchanged && $genreUnchanged) {
            toastr()->info("Nessuna modifica effettuata");
        } else {
            toastr()->success('<span class="fw-bold">' . Str::limit($videogame->name, 20) . '</span> è stato modificato con successo', ['title' => '']);
        }

        $videogame->update();

        // PIVOT

        if ($request->has("genre_ids")) {
            $videogame->genres()->sync($data["genre_ids"]);
        } else {
            $videogame->genres()->detach();
        }

        if ($request->has("console_ids")) {
            $videogame->consoles()->sync($data["console_ids"]);
        } else {
            $videogame->consoles()->detach();
        }



        return redirect()->route("admin.videogames.show", $videogame);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videogame $videogame)
    {
        $name = $videogame->name;
        $videogame->delete();

        toastr()->success("<span class='fw-bold'>" . Str::limit($name, 20) . '</span> è stato eliminato con successo');

        return back();
    }
}
