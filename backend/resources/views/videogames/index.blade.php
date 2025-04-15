@extends('layouts.master')

@section('content')
    <header class="header my-3">
        <h1>Lista dei videogiochi</h1>
    </header>

    <div class="d-flex gap-3 py-2">
        <a class="btn btn-primary" href="{{ route('admin.videogames.create') }}">Aggiungi un nuovo videogioco</a>
    </div>

    <section id="videogames" class="my-3">
        <table class="table table-bordered table-striped">
            <thead class="">
                <tr class="text-center">
                    <th>Nome videogioco</th>
                    <th>Console</th>
                    <th>Anno di uscita</th>
                    <th>Opzioni</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($videogames as $videogame)
                    <tr>
                        <td>{{ $videogame->name }}</td>
                        <td>

                            @foreach ($videogame->consoles as $console)
                                {{ $console->name }}


                                @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        <td class="text-center">

                            {{ $videogame->year_of_publication }}
                        </td>
                        </td>
                        <td class="d-flex gap-3">
                            <a id="videogame-details-btn" href="{{ route('admin.videogames.show', $videogame) }}"
                                class="btn btn-info">Dettagli</a>
                            <a class="btn btn-warning" href="{{ route('admin.videogames.edit', $videogame) }}">Modifica</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" data-videogame-id="{{ $videogame->id }}">
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
            <form id="deletevideogameForm" action="{{ route('admin.videogames.destroy', $videogame) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>

        </x-slot>
        <x-slot:delete>Elimina il videogioco </x-slot>
        <x-slot:wantDelete>Vuoi eliminare il videogioco?</x-slot>

    </x-modal>

    @push('scripts')
        <script>
            const deleteModal = document.getElementById('exampleModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const videogameId = button.getAttribute('data-videogame-id');
                const form = document.getElementById('deletevideogameForm');
                form.action = `/admin/videogames/${videogameId}`;
            });
        </script>
    @endpush
@endsection
