@php
    $routeName = Route::currentRouteName();
@endphp



@extends('layouts.master')

@section('content')
    <header class="header mb-3">
        <h1>Lista dei videogiochi</h1>
    </header>
    <x-searchbar>
        <x-slot:route>{{ route('admin.videogames.index') }}</x-slot>
        <x-slot:subject>nome</x-slot>
        <x-slot:disabled>{{ !request('search') ? 'disabled' : '' }}</x-slot>
    </x-searchbar>

    <p class="mt-3 fw-bold">Numero di videogiochi: <span class="fw-bold text-primary">{{ count($videogames) }}</span></p>

    <section id="videogames" class="my-3">

        {{-- TABLE --}}

        <table class="table table-bordered table-striped">
            <thead class="">
                <tr class="text-center">

                    {{-- TABLES'S HEADER --}}

                    <th></th>
                    <th>Nome videogioco</th>
                    <th>Console</th>
                    <th>Anno di uscita</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($videogames as $videogame)
                    {{-- ICONS --}}

                    <tr>
                        <td>
                            <div id="icons" class="d-flex align-items-center justify-content-around">
                                <a href="{{ route('admin.videogames.show', $videogame) }}"
                                    class="text-decoration-none text-dark d-flex align-items-center">
                                    <i id="eye" class="bi bi-eye"></i>
                                </a>

                                <a class=" text-decoration-none text-dark"
                                    href="{{ route('admin.videogames.edit', $videogame) }}">
                                    <i id="pencil" class="bi bi-pencil"></i>
                                </a>

                                <button type="button" class="text-decoration-none text-dark btn p-0" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-videogame-id="{{ $videogame->id }}"
                                    data-videogame-name="{{ $videogame->name }}">
                                    <i id="trash" class="bi bi-trash"></i>
                                </button>
                            </div>


                        </td>

                        {{-- NAME --}}

                        <td>{{ $videogame->name }}</td>

                        {{-- CONSOLE --}}

                        <td>
                            @foreach ($videogame->consoles as $console)
                                {{ $console->name }}
                                @if (!$loop->last)
                                    <span id="comma">,</span>
                                @endif
                            @endforeach

                            {{-- YEAR OF PUBLICATION --}}

                        <td class="text-center">
                            {{ $videogame->year_of_publication }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        {{-- PAGINATION --}}

        <div class="pagination">
            {{ $videogames->links() }}
        </div>

    </section>

    {{-- MODAL COMPONENT --}}

    @if (count($videogames) > 0)
        <x-modal>
            <x-slot:delete>Elimina <span id="videogameNameToDelete" class="fw-bold text-danger"></span> </x-slot>
            <x-slot:wantDelete>Vuoi eliminare questo videogame?</x-slot>
            <x-slot:deleteBtn>
                <form id="deleteVideogameForm" action="{{ route('admin.videogames.destroy', $videogame) }}" method="POST">
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
                const videogameId = button.getAttribute('data-videogame-id');
                const videogameName = button.getAttribute('data-videogame-name');
                const form = document.getElementById('deleteVideogameForm');
                form.action = `/admin/videogames/${videogameId}`;
                const videogameNameToDelete = document.getElementById('videogameNameToDelete');
                videogameNameToDelete.textContent = videogameName;

            });
        </script>
    @endif
@endsection
