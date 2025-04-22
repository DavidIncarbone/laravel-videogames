@extends('layouts.master')

@section('content')
    <section id="videogames">

        <header class="header my-3">
            <h1>Lista dei generi</h1>
        </header>

        <table class="table table-bordered table-striped my-3 w-100 m-auto">
            <thead>
                <tr class="text-center">
                    <th></th>
                    <th>Genere</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($genres as $genre)
                    <tr>

                        <td class="d-flex align-items-center justify-content-center gap-1 " style="height:66px;">
                            <a class=" text-decoration-none text-dark" href="{{ route('admin.genres.edit', $genre) }}">
                                <i id="pencil" class="bi bi-pencil"></i>
                            </a>
                            <button type="button" class="text-decoration-none text-dark btn p-0" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" data-genre-id="{{ $genre->id }}">
                                <i id="trash" class="bi bi-trash"></i>
                            </button>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <div style="width:150px;" class="text-center">{{ $genre->name }}</div>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $genres->links() }}
        </div>
    </section>

    <x-modal>
        <x-slot:deleteBtn>
            <form id="deleteGenreForm" action="{{ route('admin.genres.destroy', $genre) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>

        </x-slot>
        <x-slot:delete>Elimina il genere </x-slot>
        <x-slot:wantDelete>Vuoi eliminare il genere?</x-slot>

    </x-modal>


    <script>
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const genreId = button.getAttribute('data-genre-id');
            const form = document.getElementById('deleteGenreForm');
            form.action = `/admin/genres/${genreId}`;
        });
    </script>
@endsection
