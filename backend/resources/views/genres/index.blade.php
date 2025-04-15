@extends('layouts.master')

@section('content')
    <section id="videogames">

        <header class="header my-3">
            <h1>Lista dei generi</h1>
        </header>
        <div>
            <a class="btn btn-primary" href="{{ route('admin.genres.create') }}">Aggiungi genere</a>
        </div>

        <table class="table table-bordered table-striped my-3 w-100 m-auto">
            <thead>
                <tr class="text-center">
                    <th>Generi</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($genres as $genre)
                    <tr>
                        <td>
                            <div class="d-flex justify-content-around">
                                <div style="width:150px;">{{ $genre->name }}</div>
                                <div class="d-flex gap-3">
                                    <a class="btn btn-warning" href="{{ route('admin.genres.edit', $genre) }}">Modifica</a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-genre-id="{{ $genre->id }}">
                                        Elimina
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>

    <x-modal>
        <x-slot:deleteBtn>
            <form id="deletegenreForm" action="{{ route('admin.genres.destroy', $genre) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>

        </x-slot>
        <x-slot:delete>Elimina il genere </x-slot>
        <x-slot:wantDelete>Vuoi eliminare il genere?</x-slot>

    </x-modal>

    @push('scripts')
        <script>
            const deleteModal = document.getElementById('exampleModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const genreId = button.getAttribute('data-genre-id');
                const form = document.getElementById('deletegenreForm');
                form.action = `/admin/genres/${genreId}`;
            });
        </script>
    @endpush
@endsection
