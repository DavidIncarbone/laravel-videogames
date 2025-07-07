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
            <x-slot:publishers></x-slot>
            <x-slot:disabled>{{ !request('search') ? 'disabled' : '' }}</x-slot>
        </x-searchbar>



        @if (count($genres) < 1)
            <h5>Nessun genere presente</h5>
        @else
            {{-- INFO --}}

            <div class="d-flex justify-content-between align-items-center w-100 mt-3">
                <p class="mt-3 fw-bold">Numero di Generi: <span class="fw-bold text-primary">{{ $genres->total() }}</span></p>
            </div>
            <div class="d-flex align-items-start justify-content-between">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="{{ $genres->lastPage() > 1 ? 'd-block' : 'd-none' }}">Pagina
                        {{ $genres->currentPage() }} di
                        {{ $genres->lastPage() }}</div>

                    <x-paginate-query>
                        <x-slot:id>genresForm</x-slot:id>
                        <x-slot:route>{{ route('admin.genres.index') }}</x-slot:id>
                        <x-slot:hiddenPublisher></x-slot:id>
                    </x-paginate-query>
                </div>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAllModal"><i
                        class="bi bi-trash"></i>
                    <span class="d-none d-md-inline">Elimina
                        tutti</span></button>
            </div>

            <form action="{{ route('admin.genres.destroySelected') }}" method="POST">
                @csrf
                @method('DELETE')
                {{-- TABLE --}}

                <table class="table table-bordered table-striped my-3 w-100 m-auto">
                    <thead>
                        <tr class="text-center">
                            <th class="my-auto">
                                <input type="checkbox" class="select-all mt-1">
                            </th>

                            <th>Genere</th>
                            <th>Data creazione</th>
                            <th>Data ultima modifica</th>
                            <th><span class="d-none d-md-inline">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($genres as $genre)
                            <x-table>

                                {{-- CHECKBOX --}}
                                <x-slot:checkbox>
                                    <input type="checkbox" id="{{ $genre->id }}" name="selected_genres[]"
                                        value="{{ $genre->id }}"class="align-self-center"
                                        data-name="{{ $genre->name }}" data-id="{{ $genre->id }}">
                                </x-slot>

                                {{-- ICONS --}}
                                <x-slot:show></x-slot>
                                <x-slot:edit>
                                    href="{{ route('admin.genres.edit', $genre) }}"
                                </x-slot>
                                <x-slot:delete>
                                    <button type="button" class="text-decoration-none text-dark btn p-0"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-genre-id="{{ $genre->id }}"
                                        data-genre-name="{{ Str::limit($genre->name, 30) }}"
                                        data-genre-slug="{{ $genre->slug }}">
                                        <i id="trash" class="bi bi-trash"></i>
                                    </button>
                                </x-slot>

                                {{-- TD --}}

                                <x-slot:firstTd>{{ Str::limit($genre->name, 50) }}</x-slot>
                                <x-slot:secondTd></x-slot>
                                <x-slot:created>{{ $genre->created_at->format('d/m/Y H:i') }}</x-slot>
                                <x-slot:updated>{{ $genre->updated_at->format('d/m/Y H:i') }}</x-slot>
                            </x-table>
                        @endforeach
                    </tbody>
                </table>

                {{-- DELETE SELECTED MODAL COMPONENT --}}

                <x-modal-selected>
                    <x-slot:delete>Elimina i generi selezionati</x-slot>
                    <x-slot:wantDelete>I seguenti generi saranno eliminati:
                    </x-slot>
                    <x-slot:deleteBtn>

                        <input type="submit" value="Elimina definitivamente" class="btn btn-danger">

                    </x-slot>
                </x-modal-selected>
            </form>

            {{-- PAGINATION --}}

            <div class="d-flex align-items-start justify-content-between">

                <div class="pagination">
                    {{ $genres->links() }}
                </div>
                <x-selected-menu></x-selected-menu>

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
            const genreSlug = button.getAttribute('data-genre-slug');
            const genreName = button.getAttribute('data-genre-name');
            const form = document.getElementById('deleteGenreForm');
            form.action = `/admin/genres/${genreSlug}`;
            const genreNameToDelete = document.getElementById('genreNameToDelete');
            genreNameToDelete.textContent = genreName;

        });
    </script>

    {{-- MODAL ALL COMPONENT --}}

    <x-modal-all>
        <x-slot:delete>Elimina tutti i generi </x-slot>
        <x-slot:wantDelete>Vuoi davvero eliminare tutti i generi?</x-slot>
        <x-slot:deleteBtn>
            <form action="{{ route('admin.genres.destroyAll') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>
        </x-slot>
    </x-modal-all>
    @endif
@endsection
