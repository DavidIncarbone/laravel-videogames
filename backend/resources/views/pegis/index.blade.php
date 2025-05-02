@extends('layouts.master')


@section('content')
    <section id="pegis">

        <header class="header mb-3">
            <h1>Lista dei PEGI</h1>
        </header>

        {{-- SEARCHBAR --}}

        <x-searchbar>
            <x-slot:route>{{ route('admin.pegis.index') }}</x-slot>
            <x-slot:subject>età minima</x-slot>
            <x-slot:publishers></x-slot>
            <x-slot:disabled>{{ !request('search') ? 'disabled' : '' }}</x-slot>
        </x-searchbar>



        @if (count($pegis) < 1)
            <h5>Nessun PEGI presente</h5>
        @else
            {{-- INFO --}}

            <div class="d-flex justify-content-between align-items-center w-100 mt-3">
                <p class="mt-3 fw-bold">Numero di PEGI: <span class="fw-bold text-primary">{{ $pegis->total() }}</span></p>
                <button class="btn btn-danger me-3" data-bs-toggle="modal" data-bs-target="#deleteAllModal"><i
                        class="bi bi-trash"></i> <span class="d-none d-lg-inline">Elimina
                        tutti</span> </button>
            </div>
            <p class="{{ $pegis->lastPage() > 1 ? 'd-block' : 'd-none' }}">Pagina {{ $pegis->currentPage() }} di
                {{ $pegis->lastPage() }}</p>

            <form action="{{ route('admin.pegis.destroySelected') }}" method="POST">
                @csrf
                @method('DELETE')

                {{-- TABLE --}}

                <table class="table table-bordered table-striped my-3">
                    <thead>
                        <tr class="text-center">
                            <th class="my-auto">
                                <input type="checkbox" class="select-all mt-1">
                            </th>
                            <th></th>
                            <th>Logo</th>
                            <th class="d-none d-lg-table-cell">Età minima (anni)</th>
                            <th>Data creazione</th>
                            <th>Data ultima modifica</th>


                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($pegis as $pegi)
                            <x-table>

                                {{-- CHECKBOX --}}
                                <x-slot:checkbox>
                                    <input type="checkbox" id="{{ $pegi->id }}" name="selected_pegis[]"
                                        value="{{ $pegi->id }}"class="align-self-center"
                                        data-name="{{ 'PEGI ' . $pegi->age }}" data-id="{{ $pegi->id }}">
                                </x-slot>

                                {{-- ICONS --}}
                                <x-slot:show> </x-slot>
                                <x-slot:edit>
                                    href="{{ route('admin.pegis.edit', $pegi) }}"
                                </x-slot>
                                <x-slot:delete>
                                    <button type="button" class="text-decoration-none text-dark btn p-0"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-pegi-id="{{ $pegi->id }}" data-pegi-age="{{ $pegi->age }}">
                                        <i id="trash" class="bi bi-trash"></i>
                                    </button>
                                </x-slot>

                                {{-- TD --}}

                                <x-slot:firstTd>
                                    <div class="d-flex w-100 justify-content-center align-items-center">
                                        <div id="post-image" style="width: 100px; height:50px">
                                            <img id="logo" class="form-image"
                                                src="{{ asset('storage/' . $pegi->logo) }}" alt="{{ $pegi->age }}">
                                        </div>
                                    </div>
                                </x-slot>
                                <x-slot:secondTd>
                                    <td class="d-none d-lg-table-cell">
                                        {{ $pegi->age }}
                                    </td>
                                </x-slot>
                                <x-slot:created>{{ $pegi->created_at->format('d/m/Y  H:i') }}</x-slot>
                                <x-slot:updated>{{ $pegi->updated_at->format('d/m/Y  H:i') }}</x-slot>
                            </x-table>
                        @endforeach

                    </tbody>
                </table>

                {{-- DELETE SELECTED MODAL COMPONENT --}}

                <x-modal-selected>
                    <x-slot:delete>Elimina i PEGI selezionati</x-slot>
                    <x-slot:wantDelete>I seguenti PEGI saranno eliminati:
                    </x-slot>
                    <x-slot:deleteBtn>

                        <input type="submit" value="Elimina definitivamente" class="btn btn-danger">

                    </x-slot>
                </x-modal-selected>
            </form>

            {{-- PAGINATION --}}

            <div class="d-flex align-items-start justify-content-between">

                <div class="pagination">
                    {{ $pegis->links() }}
                </div>
                <x-selected-menu></x-selected-menu>

            </div>
    </section>

    {{-- MODAL COMPONENT --}}
    <x-modal>

        <x-slot:delete>Elimina <span id="pegiAgeToDelete" class="fw-bold text-danger"></span></x-slot>
        <x-slot:wantDelete>Vuoi eliminare questo PEGI?</x-slot>
        <x-slot:deleteBtn>
            <form id="deletePegiForm" action="{{ route('admin.pegis.destroy', $pegi) }}" method="POST">
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
            const pegiId = button.getAttribute('data-pegi-id');
            const pegiAge = button.getAttribute('data-pegi-age');
            const form = document.getElementById('deletePegiForm');
            form.action = `/admin/pegis/${pegiId}`;
            const pegiAgeToDelete = document.getElementById('pegiAgeToDelete');
            // console.log(pegiAgeToDelete);
            pegiAgeToDelete.textContent = `PEGI ${pegiAge}`;

        });
    </script>

    {{-- MODAL ALL --}}

    <x-modal-all>
        <x-slot:delete>Elimina tutti i PEGI </x-slot>
        <x-slot:wantDelete>Vuoi davvero eliminare tutti i PEGI?</x-slot>
        <x-slot:deleteBtn>
            <form id="deleteVideogameForm" action="{{ route('admin.pegis.destroyAll') }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>
        </x-slot>
    </x-modal-all>

    {{-- OVERLAY --}}

    <x-overlay-img>
        <x-slot:img> <img src="{{ asset('storage/' . $pegi->logo) }}" alt="PEGI {{ $pegi->age }}"
                id="overlay-img" class="rounded shadow-sm">
        </x-slot>
    </x-overlay-img>
    @endif
@endsection
