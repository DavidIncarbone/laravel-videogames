<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;

class GenreController extends Controller
{
    public function index(): JsonResponse
    {

        try {

            $genres = Genre::all();
            $genresCount = Genre::count();

            if ($genres->isEmpty()) {

                return response()->json([
                    'success' => true,
                    'message' => 'Richiesta effettuata con successo',
                    'details' => 'Non ci sono Generi nel database',
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'Richiesta effettuata con successo',
                'count' => $genresCount,
                'items' => $genres,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Errore interno del server.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}
