@extends('layouts.master')

@section('content')
    <section id="screenshots">

        <header class="header mb-3">

            <h1 class="">Lista degli screenshots</h1>
        </header>

        {{-- SEARCHBAR --}}

        <x-searchbar>
            <x-slot:route>{{ route('admin.screenshots.index') }}</x-slot>
            <x-slot:subject>nome</x-slot>
            <x-slot:publishers></x-slot>
            <x-slot:disabled>{{ !request('search') ? 'disabled' : '' }}</x-slot>
        </x-searchbar>



        @if (count($screenshots) < 1)
            <h5>Nessuno screenshot presente</h5>
            <p>Aggiungi gli screenshots dal menu di aggiunta/modifica dei videogiochi</p>
        @else
            {{-- INFO --}}

            <div class="d-flex justify-content-between align-items-center w-100 mt-3">
                <p class="mt-3 fw-bold">Numero di screenshots: <span
                        class="fw-bold text-primary">{{ $screenshots->total() }}</span>
                </p>
                <button class="btn btn-danger me-3" data-bs-toggle="modal" data-bs-target="#deleteAllModal"><i
                        class="bi bi-trash"></i> <span class="d-none d-lg-inline">Elimina
                        tutti</span></button>
            </div>
            <p class="{{ $screenshots->lastPage() > 1 ? 'd-block' : 'd-none' }}">Pagina {{ $screenshots->currentPage() }} di
                {{ $screenshots->lastPage() }}</p>

            {{-- INVISIBLE FORM FOR CREATE ROUTE --}}

            <form id="createForm" action="{{ route('admin.screenshots.create') }}" method="GET">
                <input type="hidden" name="screenshots" id="videogameInput">
            </form>


            <form action="{{ route('admin.screenshots.destroySelected') }}" method="POST">
                @csrf
                @method('DELETE')

                {{-- TABLE --}}

                <table class="table table-bordered table-striped my-3 m-auto">
                    <thead>
                        <tr class="text-center">
                            <th class="my-auto">
                                <input type="checkbox" class="select-all mt-1">
                            </th>
                            <th></th>
                            <th>Screenshot</th>
                            <th class="d-none d-lg-table-cell">Nome videogioco</th>
                            <th>Data creazione</th>
                            <th>Data ultima modifica</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($screenshots as $screenshot)
                            <x-table>

                                {{-- CHECKBOX --}}

                                <x-slot:checkbox>
                                    <input type="checkbox" id="{{ $screenshot->id }}" name="selected_screenshots[]"
                                        value="{{ $screenshot->id }}"class="align-self-center"
                                        data-screenshot="{{ $screenshot->url }}" data-id="{{ $screenshot->id }}">
                                </x-slot>

                                {{-- ICONS --}}
                                <x-slot:show>


                                    @if (count($screenshot->videogame->screenshots) < 4)
                                        <button type="button" class="btn p-0"
                                            onclick='submitCreate(@json($screenshot->videogame->slug))'>
                                            <i id="plus" class="fa-solid fa-plus"></i>
                                        </button>
                                    @endif

                                </x-slot>
                                <x-slot:edit>
                                    href="{{ route('admin.screenshots.edit', $screenshot) }}"
                                </x-slot>
                                <x-slot:delete>
                                    <button type="button" class="text-decoration-none text-dark btn p-0"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-screenshot-id="{{ $screenshot->id }}"
                                        data-screenshot-slug="{{ $screenshot->slug }}"
                                        data-screenshot-name="{{ Str::limit($screenshot->videogame->name, 30) }}"
                                        data-screenshot-url="{{ $screenshot->url }}">
                                        <i id="trash" class="bi bi-trash"></i>
                                    </button>
                                </x-slot>

                                {{-- TD --}}

                                <x-slot:firstTd>
                                    <div class="d-flex w-100 justify-content-center" style="height:66px;">
                                        <div id="post-image" class="align-self-center" style="width: 50px; height:50px">
                                            <img id="logo" class="current-screenshot"
                                                src="{{ asset('storage/' . $screenshot->url) }}"
                                                alt="{{ $screenshot->name }}">
                                        </div>
                                    </div>
                                </x-slot>
                                <x-slot:secondTd>
                                    <td class="d-none d-lg-table-cell">
                                        {{ Str::limit($screenshot->videogame->name, 50) }}
                                    </td>
                                </x-slot>
                                <x-slot:created>{{ $screenshot->created_at->format('d/m/Y  H:i') }}</x-slot>
                                <x-slot:updated>{{ $screenshot->updated_at->format('d/m/Y  H:i') }}</x-slot>
                            </x-table>
                        @endforeach

                    </tbody>
                </table>

                {{-- DELETE SELECTED MODAL COMPONENT --}}

                <x-modal-selected>
                    <x-slot:delete>Elimina gli screenshots selezionati</x-slot>
                    <x-slot:wantDelete>I seguenti screenshots saranno eliminati:
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
                    {{ $screenshots->links() }}
                </div>
                <x-selected-menu></x-selected-menu>
            </div>
    </section>

    {{-- MODAL COMPONENT --}}


    <x-modal>
        <x-slot:delete>Elimina lo screenshot di <span id="screenshotNameToDelete" class="fw-bold text-danger"></span>
        </x-slot>
        <x-slot:wantDelete>Vuoi eliminare questo screenshot?
            <div id="screenshot-container" class="mt-3" style="width:124px; height:100px;">

            </div>
        </x-slot>
        <x-slot:deleteBtn>
            <form id="deletescreenshotForm" action="{{ route('admin.screenshots.destroy', $screenshot) }}" method="POST">
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
            const screenshotSlug = button.getAttribute('data-screenshot-slug');
            const screenshotName = button.getAttribute('data-screenshot-name');
            const screenshotUrl = button.getAttribute('data-screenshot-url');

            const form = document.getElementById('deletescreenshotForm');
            form.action = `/admin/screenshots/${screenshotSlug}`;
            const screenshotNameToDelete = document.getElementById('screenshotNameToDelete');
            screenshotNameToDelete.textContent = screenshotName;

            const screenshotContainer = document.getElementById('screenshot-container');
            const screenshotToDelete = document.createElement('img');
            screenshotToDelete.src = `/storage/${screenshotUrl}`;
            screenshotToDelete.alt = screenshotName;
            screenshotContainer.appendChild(screenshotToDelete);

        });
    </script>

    {{-- MODAL ALL COMPONENT --}}

    <x-modal-all>
        <x-slot:delete>Elimina tutti gli screenshot </x-slot>
        <x-slot:wantDelete>Vuoi davvero eliminare tutti gli screenshot?</x-slot>
        <x-slot:deleteBtn>
            <form action="{{ route('admin.screenshots.destroyAll') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>
        </x-slot>
    </x-modal-all>


    {{-- OVERLAY --}}

    <x-current-screenshot-overlay>
        <x-slot:overlayTitle>Screenshots attuali </x-slot>
        <x-slot:img> <img src="" alt="" id="current-screenshot-overlay-img"
                class="rounded shadow-sm w-75 w-75">
        </x-slot>
        <x-slot:index></x-slot>
    </x-current-screenshot-overlay>

    {{-- SCRIPT FOR CREATE ROUTE --}}

    <script>
        function submitCreate(videogameSlug) {
            document.getElementById('videogameInput').value = videogameSlug;
            document.getElementById('createForm').submit();
        }
    </script>
    @endif
@endsection
