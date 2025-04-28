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

        @if (count($videogames) < 1)
            <h5>Nessun videogioco presente</h5>
        @else
            {{-- TABLE --}}

            <table class="table table-bordered table-striped">
                <thead class="">
                    <tr class="text-center">

                        {{-- TABLES'S HEADER --}}

                        <th></th>
                        <th>Nome videogioco</th>
                        <th class="d-none d-lg-block">Casa produttrice</th>
                        <th>Data creazione</th>
                        <th>Data ultima modifica</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($videogames as $videogame)
                        <x-table>

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
                                <button type="button" class="text-decoration-none text-dark btn p-0" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-videogame-slug="{{ $videogame->slug }}"
                                    data-videogame-name="{{ Str::limit($videogame->name, 30) }}">
                                    <i id="trash" class="bi bi-trash"></i>
                                </button>
                            </x-slot>

                            {{-- TD --}}

                            <x-slot:firstTd>{{ Str::limit($videogame->name, 50) }}</x-slot>
                            <x-slot:secondTd>
                                <td class="d-none d-lg-block" style="height:82px;">
                                    {{ Str::limit($videogame->publisher, 30) }}
                                </td>
                            </x-slot>
                            <x-slot:created>{{ $videogame->created_at->format('d/m/Y  H:i') }}</x-slot>
                            <x-slot:updated>{{ $videogame->updated_at->format('d/m/Y  H:i') }}</x-slot>
                        </x-table>
                    @endforeach

                </tbody>
            </table>

            {{-- PAGINATION --}}

            <div class="pagination">
                {{ $videogames->links() }}
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
        // console.log(deleteModal);
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
    @endif
@endsection
