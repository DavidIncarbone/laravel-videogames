@extends('layouts.master')

@section('content')
    <div class="container-fluid px-3 px-md-5 py-4">
        <!-- Header -->
        <header class="mb-4 text-center text-md-start">
            <h1 class="fs-2">{{ $videogame->name }}</h1>
            <p class="text-muted">Esplora i dettagli completi del mio videogioco.</p>
        </header>

        <!-- Videogame Details -->
        <section id="videogame-details">
            <div class="row gy-4">
                <!-- Videogame Image and Description -->
                <div class="col-12 col-lg-6">
                    <div class="ratio ratio-16x9 mb-3">
                        <img src="{{ asset('storage/' . $videogame->cover) }}" alt="{{ $videogame->name }}"
                            class="img-fluid rounded shadow-sm object-fit-cover">
                    </div>
                    <h5><strong>Descrizione:</strong></h5>
                    <p>{{ $videogame->description }}</p>
                </div>

                <!-- Videogame Info -->
                <div class="col-12 col-lg-6">


                    <div class="d-flex align-items-center gap-3 mb-4 flex-wrap">
                        <div style="width:50px; height:50px">
                            <img src="{{ asset('storage/' . $videogame->pegi->logo) }}"
                                alt="{{ 'PEGI ' . $videogame->pegi->age }}" class="img-fluid">
                        </div>
                        <div>
                            <div><strong>Casa produttrice:</strong> {{ $videogame->publisher }}</div>
                            <div><strong>Anno di uscita:</strong> {{ $videogame->year_of_publication }}</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <p><strong>Disponibile per:</strong></p>
                        <ul class="list-unstyled d-flex flex-wrap gap-2">
                            @foreach ($videogame->consoles as $console)
                                <li style="width: 50px; height: 50px;">
                                    <img src="{{ asset('storage/' . $console->logo) }}" alt="{{ $console->name }}"
                                        class="img-fluid">
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mb-3">
                        <p><strong>Genere:</strong></p>
                        <ul class="list-unstyled d-flex flex-wrap gap-1">
                            @foreach ($videogame->genres as $genre)
                                <li>{{ $genre->name }}</li>
                                @if (!$loop->last)
                                    <span class="mx-1">-</span>
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
