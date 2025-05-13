<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Videogame;
use App\Models\Console;
use App\Models\Genre;
use App\Models\Pegi;
use Illuminate\Http\JsonResponse;

class VideogameController extends Controller
{
    public function homePage(): JsonResponse
    {
        try {

            $latestFour = Videogame::with('screenshots')->orderBy('year_of_publication', 'desc')->take(4)->get();
            $latestFourCount = $latestFour->count();

            if ($latestFour->isEmpty()) {

                return response()->json([
                    "success" => true,
                    "message" => "Non ci sono Videogiochi nel database",
                ], 200);
            }

            return response()->json([
                "success" => true,
                "message" => "Richiesta effettuata con successo",
                "count" => $latestFourCount,
                "items" => $latestFour
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore interno del server.',
                'details' => $e->getMessage(),
            ], 500);
        };
    }

    public function index(Request $request): JsonResponse
    {
        try {

            //  dd($request);

            // dd($request->search);

            $query = Videogame::with('consoles', 'genres', 'pegi');

            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }

            // CONSOLE FILTER

            if ($request->filled('consoles')) {
                $query->whereHas('consoles', function ($relQuery) use ($request) {
                    $relQuery->whereIn('name', $request->consoles);
                    
                });
            }

            // GENRE FILTER

            if ($request->filled('genres')) {
                $query->whereHas('genres', function ($relQuery) use ($request) {
                    $relQuery->whereIn('name', $request->genres);
                });
            }

            // PEGI FILTER
            if ($request->filled('pegi')) {
                $query->whereHas('pegi', function ($q) use ($request) {
                    $q->whereIn('age', $request->pegi);
                });
            }
            $videogames = $query->paginate(6);
            $videogamesCount = $videogames->count();

            $consoles = Console::all();
            $genres = Genre::all();
            $pegis = Pegi::all();

            if ($videogames->isEmpty()) {

                return response()->json([
                    "success" => true,
                    "message" => "Richiesta effettuata con successo",
                    "details" => "Nessun videogioco soddisfa i criteri di ricerca"
                ], 200);
            }

            return response()->json([
                "success" => true,
                "message" => "Richiesta effettuata con successo",
                "count" => $videogamesCount,
                "items" => [
                    "videogames" => $videogames,
                    "consoles" => $consoles,
                    "genres" => $genres,
                    "pegis" => $pegis
                            ]
            ], 200);
        } catch (\Exception $error) {

            return response()->json([
                'success' => false,
                'message' => 'Errore interno del server.',
                'details' => $error->getMessage(),
            ], 500);
        };


    }

    public function show(Videogame $videogame)
    {

        $new = $videogame->load("consoles", "genres", "pegi", "screenshots");

        try {

            if (!$videogame) {

                return response()->json([
                    "success" => true,
                    "message" => "Richiesta effettuata con successo",
                    "details" => "Nessun videogioco soddisfa i criteri di ricerca"
                ], 200);
            }

            return response()->json([
                "success" => true,
                "message" => "Richiesta effettuata con successo",
                "item" => $new
            ], 200);
        } catch (\Exception $error) {

            return response()->json([
                'success' => false,
                'message' => 'Errore interno del server.',
                'details' => $error->getMessage(),
            ], 500);
        };
    }
}
