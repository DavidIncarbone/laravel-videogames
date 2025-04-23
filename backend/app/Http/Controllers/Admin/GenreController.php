<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Genre::query();

        if ($request->filled("search")) {
            $query->where("name", "like", "%" . $request->search . "%");
        };

        $genres = $query->paginate(5)->withQueryString();

        return view("genres/index", compact("genres"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("genres.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // VALIDATION

        // Name

        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'alpha',

            ],
        ], [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.string' => 'Il campo nome deve essere una stringa.',
            'name.min' => 'Il campo nome deve contenere almeno :min caratteri.',
            'name.max' => 'Il campo nome non può superare i :max caratteri.',
            'name.alpha' => 'Il campo nome può contenere solo lettere e spazi.',

        ]);




        $data = $request->all();
        $newGenre = new genre;
        $newGenre->name = $data["name"];


        $newGenre->save();
        toastr()->success('Genere aggiunto con successo');
        return redirect()->route("admin.genres.index", $newGenre);
    }

    /**
     * Display the specified resource.
     */
    public function show(genre $genre)
    {
        return view("genres.show", compact("genre"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(genre $genre)
    {
        return view("genres.edit", compact("genre"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, genre $genre)
    {

        // VALIDATION

        // Name
        $request->validate([
            'name' => ['required', 'string', 'min:1', 'max:255', 'regex:/^[a-zA-Z0-9\s\-\&\']+$/u'],
        ], [
            'name.required' => 'Il campo nome del videogioco è obbligatorio.',
            'name.string' => 'Il nome del videogioco deve essere una stringa.',
            'name.min' => 'Il nome del videogioco deve contenere almeno :min carattere.',
            'name.max' => 'Il nome del videogioco non può superare i :max caratteri.',
            'name.regex' => 'Il nome del videogioco contiene caratteri non validi.',

        ]);

        // DATABASE


        $data = $request->all();
        $genre->name = $data["name"];
        $genre->update();
        toastr()->success('Genere modificato con successo');
        return redirect()->route("admin.genres.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(genre $genre)
    {
        $genre->delete();
        toastr()->success('Genere eliminato con successo');
        return back();
    }
}
