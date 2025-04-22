<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Console;
use Illuminate\Support\Facades\Storage;

class ConsoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consoles = Console::all();
        return view("consoles/index", compact("consoles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("consoles/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Console $console)
    {

        // VALIDATION

        $request->validate(
            [
                'name' => ['required', 'string', 'min:1', 'max:255', 'regex:/^[a-zA-Z0-9\s\-\&\']+$/u'],
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ],

            // Name

            [
                'name.required' => 'Il campo nome del videogioco è obbligatorio.',
                'name.string' => 'Il nome del videogioco deve essere una stringa.',
                'name.min' => 'Il nome del videogioco deve contenere almeno :min carattere.',
                'name.max' => 'Il nome del videogioco non può superare i :max caratteri.',
                'name.regex' => 'Il nome del videogioco contiene caratteri non validi.',
            ],

            // Logo

            [
                'logo.image' => 'Il file caricato deve essere un\'immagine.',
                'logo.mimes' => 'Sono ammessi solo file JPEG, PNG, JPG o WEBP.',
                'logo.max' => 'La dimensione massima dell\'immagine è di 2MB.',
            ]
        );


        $data = $request->all();
        $newConsole = new Console;
        $newConsole->name = $data["name"];

        if (array_key_exists("logo", $data)) {

            $logo_url = Storage::putFile("img/consoles", $data["logo"]);
            $newConsole->logo = $logo_url;
        }

        $newConsole->save();
        toastr()->success('Console aggiunta con successo');
        return redirect()->route("admin.consoles.index", $newConsole);
    }

    /**
     * Display the specified resource.
     */
    public function show(Console $console)
    {
        return view("consoles.show", compact("console"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Console $console)
    {


        return view("consoles.edit", compact("console"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Console $console)
    {
        // VALIDATION

        $request->validate(
            [
                'name' => ['required', 'string', 'min:1', 'max:255', 'regex:/^[a-zA-Z0-9\s\-\&\']+$/u'],
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ],

            // Name

            [
                'name.required' => 'Il campo nome del videogioco è obbligatorio.',
                'name.string' => 'Il nome del videogioco deve essere una stringa.',
                'name.min' => 'Il nome del videogioco deve contenere almeno :min carattere.',
                'name.max' => 'Il nome del videogioco non può superare i :max caratteri.',
                'name.regex' => 'Il nome del videogioco contiene caratteri non validi.',
            ],

            // Logo

            [
                'logo.image' => 'Il file caricato deve essere un\'immagine.',
                'logo.mimes' => 'Sono ammessi solo file JPEG, PNG, JPG o WEBP.',
                'logo.max' => 'La dimensione massima dell\'immagine è di 2MB.',
            ]
        );


        $data = $request->all();
        // dd($data);

        $console->name = $data["name"];

        if (array_key_exists("logo", $data)) {

            $logo_url = Storage::putFile("img/consoles", $data["logo"]);
            $console->logo = $logo_url;
        }

        $console->update();

        toastr()->success('Console modificata con successo');
        return redirect()->route("admin.consoles.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Console $console)
    {
        $console->delete();
        toastr()->success('Console eliminata con successo');
        return redirect()->route("admin.consoles.index");
    }
}
