@php
    $routeName = Route::currentRouteName();
@endphp

{{-- @dd($paginate); --}}
@extends('layouts.master')

@section('content')
    <header class="header mb-3">
        <h1>Lista dei videogiochi</h1>
    </header>
    <x-searchbar>
        <x-slot:route>{{ route('admin.videogames.index') }}</x-slot>
        <x-slot:subject>nome</x-slot>
        <x-slot:publishers>
            <select name="publisher" id="select-publisher" class="form-select bg-white">
                <option value="">Tutte le case produttrici</option>
                @foreach ($publishers as $publisher)
                    <option value="{{ $publisher }}" {{ request('publisher') == $publisher ? 'selected' : '' }}>
                        {{ $publisher }}</option>
                @endforeach
            </select>

        </x-slot>
        {{-- <x-slot:paginate>{{ $paginate }}</x-slot> --}}

        <x-slot:disabled>{{ !request('search') ? 'disabled' : '' }}</x-slot>
    </x-searchbar>


    <section id="videogames" class="my-3">

        @if (count($videogames) < 1)
            <h5>Nessun videogioco presente</h5>
        @else
            {{-- INFO --}}

            <div class="d-flex justify-content-between align-items-center w-100 mt-3">
                <div class="d-flex gap-3">
                    <p class="mt-3 fw-bold">Numero di videogiochi: <span
                            class="fw-bold text-primary">{{ $videogames->total() }}</span></p>
                </div>
            </div>

            <div class="d-flex align-items-start justify-content-between">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="{{ $videogames->lastPage() > 1 ? 'd-block' : 'd-none' }}">Pagina
                        {{ $videogames->currentPage() }} di
                        {{ $videogames->lastPage() }}
                    </div>
                    <x-paginate-query>
                        <x-slot:id>videogamesForm</x-slot>
                        <x-slot:route>{{ route('admin.videogames.index') }}</x-slot>
                        <x-slot:hiddenPublisher><input type="hidden" name="publisher"
                                value="{{ request('publisher') }}"></x-slot>
                    </x-paginate-query>
                </div>
                <button class="btn btn-danger d-flex" data-bs-toggle="modal" data-bs-target="#deleteAllModal"><i
                        class="bi bi-trash"></i> <span class="">Elimina
                        tutti</span> </button>
            </div>


            {{-- TABLE --}}

            <form action="{{ route('admin.videogames.destroySelected') }}" method="POST">
                @csrf
                @method('DELETE')


                <table class="table table-bordered table-striped">
                    <thead class="">
                        <tr class="text-center">

                            {{-- TABLES'S HEADER --}}
                            <th class="my-auto">
                                <input type="checkbox" class="select-all mt-1">
                            </th>

                            <th>Nome videogioco</th>
                            <th class="d-none d-lg-table-cell">Casa produttrice</th>
                            <th>Data creazione</th>
                            <th>Data ultima modifica</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($videogames as $videogame)
                            <x-table>

                                {{-- CHECKBOX --}}
                                <x-slot:checkbox>
                                    <input type="checkbox" id="{{ $videogame->slug }}" name="selected_videogames[]"
                                        value="{{ $videogame->slug }}"class="align-self-center"
                                        data-name="{{ $videogame->name }}" data-id="{{ $videogame->id }}">
                                </x-slot>
                                {{-- ICONS --}}
                                <x-slot:show>
                                    <a href="{{ route('admin.videogames.show', $videogame) }}"
                                        class="text-decoration-none text-dark">
                                        <i id="eye" class="bi bi-eye"></i>
                                    </a>
                                </x-slot>
                                <x-slot:edit>
                                    href="{{ route('admin.videogames.edit', $videogame) }}"
                                </x-slot>
                                <x-slot:delete>
                                    <button type="button" class="text-decoration-none text-dark btn p-0"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-videogame-slug="{{ $videogame->slug }}"
                                        data-videogame-name="{{ Str::limit($videogame->name, 30) }}">
                                        <i id="trash" class="bi bi-trash"></i>
                                    </button>
                                </x-slot>

                                {{-- TD --}}

                                <x-slot:firstTd>{{ Str::limit($videogame->name, 50) }}</x-slot>
                                <x-slot:secondTd>
                                    <td class="d-none d-lg-table-cell">
                                        {{ Str::limit($videogame->publisher, 30) }}
                                    </td>
                                </x-slot>
                                <x-slot:created>
                                    {{ $videogame->created_at->format('d/m/Y  H:i') }}
                                </x-slot>
                                <x-slot:updated>{{ $videogame->updated_at->format('d/m/Y  H:i') }}</x-slot>


                            </x-table>
                        @endforeach

                    </tbody>
                </table>

                {{-- DELETE SELECTED MODAL COMPONENT --}}

                <x-modal-selected>
                    <x-slot:delete>Elimina i videogiochi selezionati</x-slot>
                    <x-slot:wantDelete>I seguenti videogiochi saranno eliminati:
                        <ul id="selected-videogames-list">

                        </ul>
                    </x-slot>
                    <x-slot:deleteBtn>

                        <input type="submit" value="Elimina definitivamente" class="btn btn-danger">

                    </x-slot>
                </x-modal-selected>
            </form>

            {{-- PAGINATION --}}

            <div class="d-flex align-items-start justify-content-between mt-3">

                <div class="pagination">
                    {{ $videogames->links() }}
                </div>

                {{-- MENU FOR DELETE --}}
                <x-selected-menu></x-selected-menu>

            </div>

    </section>

    {{-- DELETE ONE MODAL COMPONENT --}}

    <x-modal>

        <x-slot:delete>Elimina <span id="videogameNameToDelete" class="fw-bold text-danger"></span> </x-slot>
        <x-slot:wantDelete>Vuoi eliminare questo videogioco?</x-slot>
        <x-slot:deleteBtn>
            <form id="deleteVideogameForm" action="{{ route('admin.videogames.destroy', $videogame) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>

        </x-slot>
    </x-modal>

    {{-- SINGLE MODAL SCRIPT --}}

    <script>
        const deleteModal = document.getElementById('deleteModal');

        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const videogameSlug = button.getAttribute('data-videogame-slug');
            const videogameName = button.getAttribute('data-videogame-name');
            const form = document.getElementById('deleteVideogameForm');
            form.action = `/admin/videogames/${videogameSlug}`;
            const videogameNameToDelete = document.getElementById('videogameNameToDelete');
            videogameNameToDelete.textContent = videogameName;

        });
    </script>

    {{-- DELETE ALL MODAL COMPONENT --}}

    <x-modal-all>
        <x-slot:delete>Elimina tutti i videogiochi </x-slot>
        <x-slot:wantDelete>Vuoi davvero eliminare tutti i videogiochi?</x-slot>
        <x-slot:deleteBtn>
            <form id="deleteVideogameForm" action="{{ route('admin.videogames.destroyAll') }}" method="POST">
                @csrf
                @method('DELETE')
                <input id="modal-submit" type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>
        </x-slot>
    </x-modal-all>
    @endif



@endsection
