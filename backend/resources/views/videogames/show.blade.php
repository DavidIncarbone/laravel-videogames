@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <header class="header mt-5">
            <h1>{{ $videogame->name }}</h1>
            <p>Esplora i dettagli completi del mio videogioco.</p>
        </header>

        <!-- videogame Details -->
        <section id="videogame-details" class="my-3">
            <div class="row">
                <!-- videogame Image -->
                <div class="col-md-6 " style=" height:50vh">
                    <img src="{{ asset('storage/' . $videogame->cover) }}" alt="{{ $videogame->name }}"
                        class="rounded shadow-lg show-card-container">
                    <h5 class="mt-3"><strong>Descrizione:</strong></h5>
                    <p>{{ $videogame->description }} </p>
                </div>

                <!-- videogame Information -->
                <div class="col-md-6">
                    <div class="d-flex justify-content-between">
                        <h2>{{ $videogame->name }}</h2>

                    </div>
                    <div class="mb-3 d-flex gap-5">
                        <div style="width:50px; height:50px">
                            <img src="{{ asset('storage/' . $videogame->pegi->logo . '.png') }}"
                                alt="{{ 'PEGI ' . $videogame->pegi->age }}">
                        </div>
                        <div>
                            <div><strong>Casa produttrice:</strong> {{ $videogame->publisher }}</div>
                            <div><strong>Anno di uscita:</strong> {{ $videogame->year_of_publication }}</div>
                        </div>
                    </div>
                    <p><strong>Disponibile per:</strong></p>
                    <ul class="d-flex flex-wrap gap-3 list-unstyled">
                        @foreach ($videogame->consoles as $console)
                            <li style="width:50px; height:50px">
                                <img id="console-logo"
                                    src="{{ asset('storage/' . $console->logo) }}"alt="{{ $console->name }}">
                            </li>
                        @endforeach
                    </ul>

                    <div class="mb-3 d-flex gap-1">
                        <p><strong>Genere:</strong></p>
                        <ul class="list-unstyled d-flex flex-wrap gap-1">
                            @foreach ($videogame->genres as $genre)
                                <li class="text-decoration-none text-dark">{{ $genre->name }}</li>
                                @if (!$loop->last)
                                    -
                                @endif
                            @endforeach
                        </ul>
                    </div>



                </div>
            </div>
        </section>
    </div>

    @include('partials.modal')
@endsection
