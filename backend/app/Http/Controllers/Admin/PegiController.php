<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PegiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pegi::query();

        if ($request->filled("search")) {
            // dd((int)$request->search);
            $query->where("age", ">=", $request->search);
        }
        if ($request->orderFor == "create" && $request->orderBy == "desc") {
            $query->orderBy("created_at", "desc");
        } else if ($request->orderFor == "edit" && $request->orderBy == "asc") {
            $query->orderBy("updated_at");
        } else if ($request->orderFor == "edit" && $request->orderBy == "desc") {
            $query->orderBy("updated_at", "desc");
        }

        $pegis = $query->paginate(5)->withQueryString();
        return view("pegis.index", compact("pegis"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pegis.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // VALIDATION

        $request->validate(
            [
                'age' => [
                    'required',
                    'numeric',
                    'min:1',
                    'max:100',

                ],
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ],

            // Age

            [
                'age.required' => 'Il campo età è obbligatorio.',
                'age.numeric' => 'Il campo età deve essere un numero.',
                'age.min' => 'L\'età minima non può essere inferiore ad :min anno.',
                'age.max' => 'L\'età massima non può essere superiore a :max anni.',
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


        $newPegi = new Pegi;

        $newPegi->age = $data["age"];

        if (array_key_exists("logo", $data)) {
            $logo_url = Storage::putFile("img/pegis", $data["logo"]);
            $newPegi->logo = $logo_url;
        }

        $newPegi->save();
        toastr()->success("<span class='fw-bold'> PEGI " . $newPegi->age . '</span> è stato aggiunto con successo');
        return redirect()->route("admin.pegis.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pegi $pegi)
    {

        return view("pegis.edit", compact("pegi"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegi $pegi)
    {

        // VALIDATION


        $request->validate(
            [
                'age' => [
                    'required',
                    'numeric',
                    'min:1',
                    'max:100',

                ],
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            ],

            // Age

            [
                'age.required' => 'Il campo età è obbligatorio.',
                'age.numeric' => 'Il campo età deve essere un numero.',
                'age.min' => 'L\'età minima non può essere inferiore ad :min anno.',
                'age.max' => 'L\'età massima non può essere superiore a :max anni.',
            ],

            // Logo

            [
                'logo.image' => 'Il file caricato deve essere un\'immagine.',
                'logo.mimes' => 'Sono ammessi solo file JPEG, PNG, JPG o WEBP.',
                'logo.max' => 'La dimensione massima dell\'immagine è di 2MB.',
            ]
        );

        // Logo


        $data = $request->all();

        $pegi->age = $data["age"];

        if (array_key_exists("logo", $data)) {
            $logo_url = Storage::putFile("img/pegis", $data["logo"]);
            $pegi->logo = $logo_url;
        }

        if ($pegi->isClean()) {
            toastr()->info("Nessuna modifica effettuata");
        } else {
            toastr()->success("<span class='fw-bold'> PEGI " . $pegi->age . '</span> è stato modificato con successo');
        }

        $pegi->update();


        return redirect()->route("admin.pegis.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegi $pegi)
    {
        $age = $pegi->age;
        $pegi->delete();
        toastr()->success("<span class='fw-bold'> PEGI " . $age . '</span> è stato eliminato con successo');
        return back();
    }

    public function destroyAll()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Pegi::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        toastr()->success('Tutti i PEGI sono stati eliminati con successo');

        return back();
    }

    public function destroySelected(Request $request)
    {

        $ids = $request->input("selected_pegis", []);
        // dd($slugs);

        Pegi::whereIn("id", $ids)->delete();

        if (count($ids) > 1) {
            toastr()->success('I <span class="fw-bold">' . count($ids) . ' PEGI</span> selezionati sono stati eliminati con successo');
        } else {
            toastr()->success('Il PEGI selezionato è stato eliminato con successo');
        };

        return back();
    }
}
