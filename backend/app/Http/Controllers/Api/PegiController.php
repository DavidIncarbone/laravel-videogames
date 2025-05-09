<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegi;
use Illuminate\Http\JsonResponse;

class PegiController extends Controller
{
    public function index(): JsonResponse
    {

        try {

            $pegis = Pegi::all();
            $pegisCount = Pegi::count();

            if ($pegis->isEmpty()) {

                return response()->json([
                    "success" => true,
                    "message" => "Richiesta effettuata con successo",
                    "details" => "Non ci sono PEGI nel database"
                ], 200);
            }

            return response()->json([
                "success" => true,
                "message" => "Richiesta effettuata con successo",
                "count" => $pegisCount,
                "items" => $pegis
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Errore interno del server.',
                'details' => $e->getMessage(),
            ], 500);
        };
    }
}
