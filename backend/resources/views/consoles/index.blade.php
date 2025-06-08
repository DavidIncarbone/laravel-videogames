@extends('layouts.master')

@section('content')
    <section id="consoles">

        <header class="header mb-3">

            <h1 class="">Lista delle console</h1>
        </header>

        {{-- SEARCHBAR --}}

        <x-searchbar>
            <x-slot:route>{{ route('admin.consoles.index') }}</x-slot>
            <x-slot:subject>nome</x-slot>
            <x-slot:publishers></x-slot>
            <x-slot:disabled>{{ !request('search') ? 'disabled' : '' }}</x-slot>
        </x-searchbar>

        @if (count($consoles) < 1)
            <h5>Nessuna console presente</h5>
        @else
            {{-- INFO --}}

            <div class="d-flex justify-content-between align-items-center w-100 mt-3">
                <p class="mt-3 fw-bold">Numero di console: <span class="fw-bold text-primary">{{ $consoles->total() }}</span>
                </p>
                <button class="btn btn-danger me-3" data-bs-toggle="modal" data-bs-target="#deleteAllModal"><i
                        class="bi bi-trash"></i> <span class="">Elimina
                        tutti</span></button>
            </div>
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="{{ $consoles->lastPage() > 1 ? 'd-block' : 'd-none' }}">Pagina
                    {{ $consoles->currentPage() }} di
                    {{ $consoles->lastPage() }}</div>

                <x-paginate-query>
                    <x-slot:id>consolesForm</x-slot>
                    <x-slot:route>{{ route('admin.consoles.index') }}</x-slot>
                    <x-slot:hiddenPublisher></x-slot>
                </x-paginate-query>
            </div>

            <form action="{{ route('admin.consoles.destroySelected') }}" method="POST">
                @csrf
                @method('DELETE')

                {{-- TABLE --}}

                <table class="table table-bordered table-striped my-3 m-auto">
                    <thead>
                        <tr class="text-center">
                            <th class="my-auto">
                                <input type="checkbox" class="select-all mt-1">
                            </th>

                            <th>Console</th>
                            <th class="d-none d-lg-table-cell">Logo</th>
                            <th>Data creazione</th>
                            <th>Data ultima modifica</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($consoles as $console)
                            <x-table>

                                {{-- CHECKBOX --}}

                                <x-slot:checkbox>
                                    <input type="checkbox" id="{{ $console->id }}" name="selected_consoles[]"
                                        value="{{ $console->id }}"class="align-self-center"
                                        data-name="{{ $console->name }}" data-id="{{ $console->id }}">
                                </x-slot>

                                {{-- ICONS --}}
                                <x-slot:show> </x-slot>
                                <x-slot:edit>
                                    href="{{ route('admin.consoles.edit', $console) }}"
                                </x-slot>
                                <x-slot:delete>
                                    <button type="button" class="text-decoration-none text-dark btn p-0"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-console-id="{{ $console->id }}"
                                        data-console-name="{{ Str::limit($console->name, 30) }}"
                                        data-console-slug="{{ $console->slug }}">
                                        <i id="trash" class="bi bi-trash"></i>
                                    </button>
                                </x-slot>

                                {{-- TD --}}

                                <x-slot:firstTd>{{ Str::limit($console->name, 50) }}</x-slot>
                                <x-slot:secondTd>
                                    <td class="d-none d-lg-table-cell">
                                        <div class="d-flex w-100 justify-content-center" style="height:66px;">
                                            <div id="post-image" class="align-self-center"
                                                style="width: 100px; height:50px">
                                                <img id="logo" class="current-screenshot"
                                                    src="{{ asset('storage/' . $console->logo) }}"
                                                    alt="{{ $console->name }}">
                                            </div>
                                        </div>
                                    </td>
                                </x-slot>
                                <x-slot:created>{{ $console->created_at->format('d/m/Y  H:i') }}</x-slot>
                                <x-slot:updated>{{ $console->updated_at->format('d/m/Y  H:i') }}</x-slot>


                            </x-table>
                        @endforeach

                    </tbody>
                </table>

                {{-- DELETE SELECTED MODAL COMPONENT --}}

                <x-modal-selected>
                    <x-slot:delete>Elimina le console selezionate</x-slot>
                    <x-slot:wantDelete>Le seguenti console saranno eliminate:
                        <ul id="selected-videogames-list">

                        </ul>
                    </x-slot>
                    <x-slot:deleteBtn>

                        <input type="submit" value="Elimina definitivamente" class="btn btn-danger">

                    </x-slot>
                </x-modal-selected>
            </form>

            {{-- PAGINATION --}}

            <div class="d-flex align-items-start justify-content-between">

                <div class="pagination">
                    {{ $consoles->links() }}
                </div>
                <x-selected-menu></x-selected-menu>
            </div>
    </section>

    {{-- MODAL COMPONENT --}}


    <x-modal>
        <x-slot:delete>Elimina <span id="consoleNameToDelete" class="fw-bold text-danger"></span> </x-slot>
        <x-slot:wantDelete>Vuoi eliminare questa console?</x-slot>
        <x-slot:deleteBtn>
            <form id="deleteConsoleForm" action="{{ route('admin.consoles.destroy', $console) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>
        </x-slot>
    </x-modal>

    {{-- MODAL SCRIPT --}}


    <script>
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const consoleSlug = button.getAttribute('data-console-slug');
            const consoleName = button.getAttribute('data-console-name');
            const form = document.getElementById('deleteConsoleForm');
            form.action = `/admin/consoles/${consoleSlug}`;
            const consoleNameToDelete = document.getElementById('consoleNameToDelete');
            consoleNameToDelete.textContent = consoleName;
        });
    </script>

    {{-- MODAL ALL COMPONENT --}}

    <x-modal-all>
        <x-slot:delete>Elimina tutte le console </x-slot>
        <x-slot:wantDelete>Vuoi davvero eliminare tutte le console?</x-slot>
        <x-slot:deleteBtn>
            <form action="{{ route('admin.consoles.destroyAll') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>
        </x-slot>
    </x-modal-all>

    {{-- OVERLAY --}}


    <x-current-screenshot-overlay>
        <x-slot:overlayTitle>Loghi attuali</x-slot>
        <x-slot:img> <img src="" alt="" id="current-screenshot-overlay-img"
                class="rounded shadow-sm w-75 w-75">
        </x-slot>
        <x-slot:index></x-slot>
    </x-current-screenshot-overlay>
    @endif
@endsection
