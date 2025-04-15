@php
    use App\Models\Videogame;
    use App\Models\Console;
    use App\Models\Genre;
    use App\Models\Pegi;

    $videogamesCount = Videogame::all()->count();
    $consolesCount = Console::all()->count();
    $genresCount = Genre::all()->count();
    $pegisCount = Pegi::all()->count();

@endphp


@extends('layouts.master')

@section('content')
    <!-- Contenuto principale -->
    <div class="flex-grow-1 p-4">
        <div class="header d-flex justify-content-between align-items-center mb-4">
            <h1>Benvenuto nella tua Dashboard</h1>

        </div>

        <div class="row">
            <!-- Card per statistiche portfolio -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Videogiochi</h5>
                        <p class="card-text"><strong>{{ $videogamesCount }}</strong></p>
                    </div>
                </div>
            </div>
            <!-- Card per statistiche utenti -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Consoles</h5>
                        <p class="card-text"><strong>{{ $consolesCount }}</strong></p>
                    </div>
                </div>
            </div>
            <!-- Card per altre informazioni -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Generi</h5>
                        <p class="card-text"><strong>{{ $genresCount }}</strong></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">PEGI</h5>
                        <p class="card-text"><strong>{{ $pegisCount }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
