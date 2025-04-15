@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <header class="header mt-5">
            <h1>{{ $videogame->name }}</h1>
            <p>Esplora i dettagli completi del mio videogioco.</p>
        </header>

        <!-- videogame Details -->
        <section id="videogame-details" class="my-5">
            <div class="row">
                <!-- videogame Image -->
                <div class="col-md-6 " style=" height:50vh">
                    <img src="{{ asset('storage/' . $videogame->cover) }}" alt="{{ $videogame->name }}"
                        class="rounded shadow-lg show-card-container">
                </div>

                <!-- videogame Information -->
                <div class="col-md-6">
                    <div class="d-flex justify-content-between">
                        <h2>{{ $videogame->name }}</h2>

                    </div>
                    <p><strong>Disponibile per:</strong></p>
                    <ul>
                        @foreach ($videogame->consoles as $console)
                            <li>{{ $console->name }}</li>
                        @endforeach
                    </ul>

                    <div class="mb-3">
                        <p><strong>Genere:</strong></p>
                        @foreach ($videogame->genres as $genre)
                            <li class="text-decoration-none text-dark">{{ $genre->name }}</li>
                        @endforeach
                    </div>
                    <div style="width:50px; height:50px" class="mb-3">
                        <img src="{{ asset('storage/' . $videogame->pegi->logo . '.png') }}"
                            alt="{{ 'PEGI ' . $videogame->pegi->age }}">
                    </div>
                    <p><strong>Casa produttrice:</strong> {{ $videogame->publisher }}</p>
                    <p><strong>Anno di uscita:</strong> {{ $videogame->year_of_publication }}</p>
                    <p><strong>Descrizione:</strong>{{ $videogame->description }} </p>
                </div>
            </div>
        </section>
    </div>

    @include('partials.modal')
@endsection
