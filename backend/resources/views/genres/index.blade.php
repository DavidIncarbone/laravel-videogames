@extends('layouts.master')

@section('content')
    <section id="videogames" class="my-5">

        <h1 class="text-center p-3">Lista delle generi</h1>

        <a class="btn btn-primary" href="{{ route('admin.genres.create') }}">Aggiungi genere</a>

        <table class="table table-bordered table-striped my-3">
            <thead>
                <tr class="text-center">
                    <th>Genere</th>

                    <th>Opzioni</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($genres as $genre)
                    <tr>
                        <td class="text-center">{{ $genre->name }}</td>

                        <td class="d-flex justify-content-center gap-3">

                            <a class="btn btn-warning" href="{{ route('admin.genres.edit', $genre) }}">Modifica</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" data-genre-id="{{ $genre->id }}">
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
