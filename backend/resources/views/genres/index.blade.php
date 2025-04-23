@extends('layouts.master')

@section('content')
    <section id="genres">

        <header class="header mb-3">
            <h1>Lista dei generi</h1>
        </header>

        {{-- SEARCHBAR --}}

        <x-searchbar>
            <x-slot:route>{{ route('admin.genres.index') }}</x-slot>
            <x-slot:subject>nome</x-slot>
            <x-slot:disabled>{{ !request('search') ? 'disabled' : '' }}</x-slot>
        </x-searchbar>

        {{-- TABLE --}}

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

                        {{-- ICONS --}}

                        <td class="d-flex align-items-center justify-content-center gap-1 " style="height:66px;">
                            <a class=" text-decoration-none text-dark" href="{{ route('admin.genres.edit', $genre) }}">
                                <i id="pencil" class="bi bi-pencil"></i>
                            </a>
                            <button type="button" class="text-decoration-none text-dark btn p-0" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" data-genre-id="{{ $genre->id }}"
                                data-genre-name='{{ $genre->name }}'>
                                <i id="trash" class="bi bi-trash"></i>
                            </button>
                        </td>

                        {{-- NAME --}}

                        <td class="">
                            <div class="d-flex justify-content-center align-items-center w-100 "
                                style="width:150px; height:50px;">
                                <div class="text-center">{{ $genre->name }}</div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- PAGINATION --}}

        <div class="pagination">
            {{ $genres->links() }}
        </div>
    </section>

    {{-- MODAL COMPONENT --}}

    <x-modal>
        <x-slot:delete>Elimina <span id="genreNameToDelete" class="fw-bold text-danger"></span> </x-slot>
        <x-slot:wantDelete>Vuoi eliminare questo genere?</x-slot>
        <x-slot:deleteBtn>
            <form id="deleteGenreForm" action="{{ route('admin.genres.destroy', $genre) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>

        </x-slot>


    </x-modal>

    {{-- MODAL SCRIPT --}}

    <script>
        const deleteModal = document.getElementById('deleteModal');
        // console.log(deleteModal);
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const genreId = button.getAttribute('data-genre-id');
            const genreName = button.getAttribute('data-genre-name');
            const form = document.getElementById('deleteGenreForm');
            form.action = `/admin/genres/${genreId}`;
            const genreNameToDelete = document.getElementById('genreNameToDelete');
            genreNameToDelete.textContent = genreName;

        });
    </script>
@endsection
