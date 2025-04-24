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
            <x-slot:disabled>{{ !request('search') ? 'disabled' : '' }}</x-slot>
        </x-searchbar>

        <p class="mt-3 fw-bold">Numero di PEGI: <span class="fw-bold text-primary">{{ count($pegis) }}</span></p>

        {{-- TABLE --}}

        <table class="table table-bordered table-striped my-3">
            <thead>
                <tr class="text-center">
                    <th></th>
                    <th>Logo</th>
                    <th class="d-none d-lg-block">Età minima (anni)</th>
                    <th>Data creazione</th>
                    <th>Data ultima modifica</th>


                </tr>
            </thead>
            <tbody>

                @foreach ($pegis as $pegi)
                    <x-table>

                        {{-- ICONS --}}
                        <x-slot:show> </x-slot>
                        <x-slot:edit>
                            href="{{ route('admin.pegis.edit', $pegi) }}"
                        </x-slot>
                        <x-slot:delete>
                            <button type="button" class="text-decoration-none text-dark btn p-0" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" data-pegi-id="{{ $pegi->id }}"
                                data-pegi-age="{{ $pegi->age }}">
                                <i id="trash" class="bi bi-trash"></i>
                            </button>
                        </x-slot>

                        {{-- TD --}}

                        <x-slot:firstTd>
                            <div class="d-flex w-100 justify-content-center align-items-center">
                                <div id="post-image" style="width: 100px; height:50px">
                                    <img id="logo" class="" src="{{ asset('storage/' . $pegi->logo) }}"
                                        alt="{{ $pegi->age }}">
                                </div>
                            </div>
                        </x-slot>
                        <x-slot:secondTd>
                            <td class="d-none d-lg-block" style="height:82px;">

                                <div class="d-flex justify-content-center align-items-center " style="height:50px">
                                    <div>{{ $pegi->age }}</div>
                                </div>
                            </td>
                        </x-slot>
                        <x-slot:created>{{ $pegi->created_at->format('d/m/Y  H:i') }}</x-slot>
                        <x-slot:updated>{{ $pegi->updated_at->format('d/m/Y  H:i') }}</x-slot>
                    </x-table>
                @endforeach

            </tbody>
        </table>

        {{-- PAGINATION --}}

        <div class="pagination">
            {{ $pegis->links() }}
        </div>
    </section>



    @if (count($pegis) > 0)
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
    @endif
@endsection
