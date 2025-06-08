<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreGenreRequest;
use App\Http\Requests\Update\UpdateGenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Genre::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->orderFor == 'create' && $request->orderBy == 'desc') {
            $query->orderBy('created_at', 'desc');
        } elseif ($request->orderFor == 'edit' && $request->orderBy == 'asc') {
            $query->orderBy('updated_at');
        } elseif ($request->orderFor == 'edit' && $request->orderBy == 'desc') {
            $query->orderBy('updated_at', 'desc');
        }

        $paginate = request()->paginate;

        $genres = $query->paginate($paginate ?? 5)->withQueryString();

        return view('genres/index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request)
    {

        // VALIDATION

        // Name

        $data = $request->validated();
        $newGenre = new Genre;
        $newGenre->name = Str::of($data['name'])->trim();

        $newGenre->save();
        toastr()->success("<span class='fw-bold'>" . Str::limit($newGenre->name, 20) . '</span> è stato aggiunto con successo');

        return redirect()->route('admin.genres.index', $newGenre);
    }

    /**
     * Display the specified resource.
     */
    public function show(genre $genre)
    {
        return view('genres.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, genre $genre)
    {

        // DATABASE

        $data = $request->validated();
        $genre->name = $data['name'];

        if ($genre->isClean()) {
            toastr()->info('Nessuna modifica effettuata');
        } else {
            toastr()->success("<span class='fw-bold'>" . Str::limit($genre->name, 20) . '</span> è stato modificato con successo');
        }

        $genre->update();

        return redirect()->route('admin.genres.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $name = $genre->name;
        // dd($name);
        $genre->delete();
        toastr()->success("<span class='fw-bold'>" . Str::limit($name, 20) . '</span> è stato eliminato con successo');

        return back();
    }

    public function destroyAll()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Genre::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        toastr()->success('Tutti i generi sono stati eliminati con successo');

        return back();
    }

    public function destroySelected(Request $request)
    {

        $ids = $request->input('selected_genres', []);
        // dd($slugs);

        Genre::whereIn('id', $ids)->delete();

        if (count($ids) > 1) {
            toastr()->success('I <span class="fw-bold">' . count($ids) . ' Generi</span> selezionati sono stati eliminati con successo');
        } else {
            toastr()->success('Il genere selezionato è stato eliminato con successo');
        }

        return back();
    }
}
