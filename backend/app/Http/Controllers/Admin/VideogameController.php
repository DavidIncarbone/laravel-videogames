<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVideogameRequest;
use App\Http\Requests\UpdateVideogameRequest;
use App\Models\Videogame;
use App\Models\Console;
use App\Models\Genre;
use App\Models\Pegi;
use App\Models\Screenshot;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class VideogameController extends Controller
{

    public function index(Request $request)
    {
        // dd($request);
        $query = Videogame::query();


        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        };
        if ($request->filled('publisher')) {
            $query->where('publisher', $request->publisher);
        }
        if ($request->orderFor == "create" && $request->orderBy == "desc") {
            $query->orderBy("created_at", "desc");
        } else if ($request->orderFor == "edit" && $request->orderBy == "asc") {
            $query->orderBy("updated_at");
        } else if ($request->orderFor == "edit" && $request->orderBy == "desc") {
            $query->orderBy("updated_at", "desc");
        }

        $videogames = $query->paginate(5)->withQueryString();
        $publishers = Videogame::all()->pluck("publisher")->toArray();

        $consoles = Console::all();
        return view("videogames.index", compact("videogames", "publishers"));
    }


    public function create()
    {
        $consoles = Console::all();
        $genres = Genre::all();
        $pegis = Pegi::all();

        return view("videogames.create", compact("consoles", "genres", "pegis"));
    }


    public function store(StoreVideogameRequest $request)

    {

        // VALIDATION

        $request->validated();

        // DATABASE

        $data = $request->all();
        $newVideogame = new Videogame();


        $newVideogame->pegi_id = $data["pegi_id"];
        $newVideogame->name = Str::of($data["name"])->trim();
        $newVideogame->price = $data["price"];
        $newVideogame->publisher = Str::of($data["publisher"])->trim();
        $newVideogame->year_of_publication = $data["year_of_publication"];
        $newVideogame->description = Str::of($data["description"])->trim();

        // COVER

        if (array_key_exists("cover", $data)) {
            $cover_url = Storage::putFile("img/videogames/covers", $data["cover"]);
            $newVideogame->cover = $cover_url;
        }

        $newVideogame->save();

        // PIVOT

        if ($request->has("genre_ids")) {
            $newVideogame->genres()->attach($data["genre_ids"]);
        }
        if ($request->has("console_ids")) {
            $newVideogame->consoles()->attach($data["console_ids"]);
        }

        // SCREENSHOTS

        $latestVideogame = Videogame::latest()->first();

        if (array_key_exists("screenshots", $data)) {

            $screenshots = $data['screenshots'];
            foreach ($screenshots as $screenshot) {
                $newScreenshots = new Screenshot;
                $newScreenshots->videogame_id = $latestVideogame->id;
                $screenshots_url = Storage::putFile("img/videogames/screenshots", $screenshot);
                $newScreenshots->url = $screenshots_url;
                $newScreenshots->save();
            }
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
        $screenshotsCount = $videogame->screenshots->count();

        return view("videogames.edit", compact("videogame", "consoles", "genres", "pegis", "screenshotsCount"));
    }


    public function update(UpdateVideogameRequest $request, Videogame $videogame)
    {

        // dd($request);

        // ADD THIS ARRAYS ANYWAY

        $request->merge([
            'genre_ids' => $request->input('genre_ids', []),
            'console_ids' => $request->input('console_ids', [])
        ]);

        // VALIDATION

        $request->validated();

        // SAVE TO DB

        $data = $request->all();


        $videogame->pegi_id = $data["pegi_id"];
        $videogame->name = $data["name"];
        $videogame->publisher = $data["publisher"];
        $videogame->year_of_publication = $data["year_of_publication"];
        $videogame->description = $data["description"];


        if (array_key_exists("cover", $data)) {

            $cover = $data['cover'];
            $oldCover = $videogame->cover;
            Storage::delete($oldCover);

            $cover_url = Storage::putFile("img/videogames/covers", $cover);
            $videogame->cover = $cover_url;
        }

        // SCREENSHOTS

        if (array_key_exists("screenshots", $data)) {

            $screenshots = $data['screenshots'];
            $oldScreenshots = Screenshot::where("videogame_id", $videogame->id)->get();
            foreach ($oldScreenshots as $oldScreenshot) {
                Storage::delete($oldScreenshot->url);
            }

            Screenshot::where("videogame_id", $videogame->id)->delete();

            foreach ($screenshots as $screenshot) {
                $newScreenshots = new Screenshot;
                $newScreenshots->videogame_id = $videogame->id;
                $screenshots_url = Storage::putFile("img/videogames/screenshots", $screenshot);
                $newScreenshots->url = $screenshots_url;
                $newScreenshots->save();
            }
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

        if ($videogameUnchanged && $consoleUnchanged && $genreUnchanged && !array_key_exists("screenshots", $data)) {
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

    public function destroyAll()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Videogame::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        toastr()->success('Tutti i videogiochi sono stati eliminati con successo');

        return back();
    }

    public function destroySelected(Request $request)
    {

        $slugs = $request->input("selected_videogames", []);

        // dd($slugs);

        Videogame::whereIn("slug", $slugs)->delete();

        if (count($slugs) > 1) {
            toastr()->success('I <span class="fw-bold">' . count($slugs) . ' Videogiochi</span> selezionati sono stati eliminati con successo');
        } else {
            toastr()->success('Il videogioco selezionato è stato eliminato con successo');
        };

        return back();
    }

    public function destroyShow(Videogame $videogame)
    {

        $name = $videogame->name;

        $videogame->delete();

        toastr()->success("<span class='fw-bold'>" . Str::limit($name, 20) . "</span> è stato eliminato con successo");

        return redirect()->route("admin.videogames.index");
    }
}
