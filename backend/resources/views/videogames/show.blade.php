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
                    <img src="{{ asset('storage/' . $videogame->image) }}" alt="{{ $videogame->name }}"
                        class="rounded shadow-lg show-card-container">
                </div>

                <!-- videogame Information -->
                <div class="col-md-6">
                    <div class="d-flex justify-content-between">
                        <h2>{{ $videogame->name }}</h2>
                        <div>
                            <a class="btn btn-warning" href="{{ route('admin.videogames.edit', $videogame) }}">Modifica</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Elimina
                            </button>
                        </div>
                    </div>
                    <p><strong>Tipo:</strong> {{ $videogame->type->name }}</p>

                    <div class="mb-3">

                        @foreach ($videogame->genres as $genre)
                            <a href="{{ route('admin.genres.show', $genre) }}" class="badge text-decoration-none"
                                style="background-color: {{ $genre->color }}">{{ $genre->name }}</a>
                        @endforeach
                    </div>
                    <p><strong>Cliente:</strong> {{ $videogame->customer }}</p>
                    <p><strong>Periodo di Realizzazione:</strong> {{ $videogame->period }}</p>
                    <p><strong>Descrizione:</strong>{{ $videogame->summary }} </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-4">
                <a href="{{ $videogame->link }}" class="btn btn-success" target="_blank">Visita il Sito del videogioco</a>
            </div>
        </section>
    </div>

    @include('partials.modal')
@endsection
