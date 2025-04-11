@extends('layouts.master')

@section('content')
    <header class="header mt-5">
        <h1>Lista dei videogiochi</h1>
        <p>Scopri i dettagli dei miei videogiochi più recenti.</p>
    </header>

    <div class="d-flex gap-3 py-4">
        <a class="btn btn-primary" href="{{ route('admin.videogames.create') }}">Aggiungi un nuovo videogioco</a>



    </div>

    <!-- Table of videogames -->
    <section id="videogames" class="my-5">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th>Nome videogioco</th>
                    <th>console</th>
                    <th>Nome Cliente</th>
                    <th>Periodo di Realizzazione</th>
                    <th>Descrizione</th>
                    <th>Opzioni</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($videogames as $videogame)
                    <tr>
                        <td>{{ $videogame->name }}</td>
                        <td>{{ $videogame->console->name }}</td>
                        <td>{{ $videogame->customer }}</td>
                        <td>{{ $videogame->period }}</td>
                        @php
                            $maxWords = 10;
                            $words = explode(' ', $videogame->summary);
                            $shortenedDescription = implode(' ', array_slice($words, 0, $maxWords));
                        @endphp
                        <td>{{ $shortenedDescription }}...</td>
                        <td class="d-flex gap-3">
                            <a id="videogame-details-btn" href="{{ route('admin.videogames.show', $videogame) }}"
                                class="btn btn-info">Dettagli</a>
                            <a class="btn btn-warning" href="{{ route('admin.videogames.edit', $videogame) }}">Modifica</a>
                            <button console="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Elimina
                            </button>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>

    @include('partials.modal')
@endsection
