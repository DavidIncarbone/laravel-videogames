@extends('layouts.master')

@section('content')
    <section id="consoles">

        <header class="header mb-3">

            <h1 class="">Lista delle consoles</h1>
        </header>

        {{-- SEARCHBAR --}}

        <x-searchbar>
            <x-slot:route>{{ route('admin.consoles.index') }}</x-slot>
            <x-slot:subject>nome</x-slot>
            <x-slot:disabled>{{ !request('search') ? 'disabled' : '' }}</x-slot>
        </x-searchbar>

        <p class="mt-3 fw-bold">Numero di consoles: <span class="fw-bold text-primary">{{ count($consoles) }}</span></p>

        @if (count($consoles) < 1)
            <h5>Nessuna console presente</h5>
        @else
            <p class="{{ $consoles->lastPage() > 1 ? 'd-block' : 'd-none' }}">Pagina {{ $consoles->currentPage() }} di
                {{ $consoles->lastPage() }}</p>

            {{-- TABLE --}}

            <table class="table table-bordered table-striped my-3 m-auto">
                <thead>
                    <tr class="text-center">
                        <th></th>
                        <th>Console</th>
                        <th class="d-none d-lg-block">Logo</th>
                        <th>Data creazione</th>
                        <th>Data ultima modifica</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($consoles as $console)
                        <x-table>

                            {{-- ICONS --}}
                            <x-slot:show> </x-slot>
                            <x-slot:edit>
                                href="{{ route('admin.consoles.edit', $console) }}"
                            </x-slot>
                            <x-slot:delete>
                                <button type="button" class="text-decoration-none text-dark btn p-0" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-console-id="{{ $console->id }}"
                                    data-console-name="{{ Str::limit($console->name, 30) }}">
                                    <i id="trash" class="bi bi-trash"></i>
                                </button>
                            </x-slot>

                            {{-- TD --}}

                            <x-slot:firstTd>{{ Str::limit($console->name, 50) }}</x-slot>
                            <x-slot:secondTd>
                                <td class="d-none d-lg-block" style="height:82px">
                                    <div class="d-flex w-100 justify-content-center align-items-center">
                                        <div id="post-image" style="width: 100px; height:50px">
                                            <img id="logo" class=""
                                                src="{{ asset('storage/' . $console->logo) }}" alt="{{ $console->name }}">
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

            {{-- PAGINATION --}}

            <div class="d-flex align-items-start justify-content-between">

                <div class="pagination">
                    {{ $consoles->links() }}
                </div>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAllModal"><i
                        class="bi bi-trash"></i> Elimina tutte </button>
            </div>

            {{-- DELETE ALL --}}



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
            const consoleId = button.getAttribute('data-console-id');
            const consoleName = button.getAttribute('data-console-name');
            const form = document.getElementById('deleteConsoleForm');
            form.action = `/admin/consoles/${consoleId}`;
            const consoleNameToDelete = document.getElementById('consoleNameToDelete');
            consoleNameToDelete.textContent = consoleName;
        });
    </script>

    {{-- MODAL ALL COMPONENT --}}

    <x-modal-all>
        <x-slot:delete>Elimina tutte le consoles </x-slot>
        <x-slot:wantDelete>Vuoi davvero eliminare tutte le consoles?</x-slot>
        <x-slot:deleteBtn>
            <form action="{{ route('admin.consoles.destroyAll') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>
        </x-slot>
    </x-modal-all>
    @endif
@endsection
