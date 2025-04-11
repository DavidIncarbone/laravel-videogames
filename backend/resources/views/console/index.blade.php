@extends('layouts.master')

@section('content')
    <section id="videogames" class="my-5">

        <h1 class="text-center p-3">Lista delle console</h1>

        <a class="btn btn-primary" href="{{ route('admin.console.create') }}">Aggiungi console</a>

        <table class="table table-bordered table-striped my-3">
            <thead>
                <tr class="text-center">
                    <th>console</th>
                    <th>Descrizione</th>
                    <th>Opzioni</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($console as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        @php
                            $maxWords = 20;
                            $words = explode(' ', $type->description);
                            $shortenedDescription = implode(' ', array_slice($words, 0, $maxWords));
                        @endphp
                        <td>{{ $shortenedDescription }}...</td>
                        <td class="d-flex justify-content-center gap-3">
                            <a id="type-details-btn" href="{{ route('admin.console.show', $type) }}"
                                class="btn btn-info">Dettagli</a>
                            <a class="btn btn-warning" href="{{ route('admin.console.edit', $type) }}">Modifica</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Elimina
                            </button>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>

    <x-modal>
        <x-slot:deleteBtn>
            <form action="{{ route('admin.console.destroy', $type) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>
            <x-slot:delete>Elimina la console </x-slot>
            <x-slot:wantDelete>Vuoi eliminare la console?</x-slot>

        </x-slot>

    </x-modal>
@endsection
