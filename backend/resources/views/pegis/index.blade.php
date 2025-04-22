@extends('layouts.master')

@section('content')
    <section id="pegis">

        <header class="header mb-3">
            <h1>Lista dei PEGI</h1>
        </header>

        {{-- TABLE --}}

        <table class="table table-bordered table-striped my-3">
            <thead>
                <tr class="text-center">
                    <th></th>
                    <th>Logo</th>
                    <th>Età minima (anni)</th>


                </tr>
            </thead>
            <tbody>

                @foreach ($pegis as $pegi)
                    {{-- ICONS --}}

                    <tr>
                        <td class="d-flex align-items-center justify-content-center gap-1 " style="height:66px;">
                            <a class=" text-decoration-none text-dark" href="{{ route('admin.pegis.edit', $pegi) }}">
                                <i id="pencil" class="bi bi-pencil"></i>
                            </a>
                            <button type="button" class="text-decoration-none text-dark btn p-0" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" data-pegi-id="{{ $pegi->id }}"
                                data-pegi-age='{{ $pegi->age }}'>
                                <i id="trash" class="bi bi-trash"></i>
                            </button>
                        </td>

                        {{-- AGE --}}

                        <td>
                            <div class="d-flex align-items-center justify-content-around">

                                <div class="d-flex">
                                    <div id="post-image" style="width: 100px; height:50px">
                                        <img id="logo" src="{{ asset('storage/' . $pegi->logo) }}"
                                            alt="{{ 'PEGI' . $pegi->age }}">

                                    </div>

                                </div>

                        </td>
                        {{-- AGE --}}


                        <td>

                            <div class="d-flex justify-content-center align-items-center" style="height:50px">
                                <div>{{ $pegi->age }}</div>
                            </div>

                        </td>


                    </tr>
                @endforeach

            </tbody>
        </table>

        {{-- PAGINATION --}}

        <div class="pagination">
            {{ $pegis->links() }}
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
@endsection
