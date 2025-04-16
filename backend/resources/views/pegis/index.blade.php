@extends('layouts.master')

@section('content')
    <section id="pegis">

        <header class="header my-3">
            <h1>Lista dei PEGI</h1>
        </header>

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
                    <tr>
                        <td class="d-flex align-items-center justify-content-center gap-1 " style="height:66px;">
                            <a class=" text-decoration-none text-dark" href="{{ route('admin.pegis.edit', $pegi) }}">
                                <i id="pencil" class="bi bi-pencil"></i>
                            </a>
                            <button type="button" class="text-decoration-none text-dark btn p-0" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" data-pegi-id="{{ $pegi->id }}">
                                <i id="trash" class="bi bi-trash"></i>
                            </button>
                        </td>
                        <td>
                            <div class="d-flex align-items-center justify-content-around">

                                <div class="d-flex">
                                    <div id="post-image" style="width: 100px; height:50px">
                                        <img id="logo" class="" src="{{ asset('storage/' . $pegi->logo) }}"
                                            alt="{{ 'PEGI' . $pegi->age }}">

                                    </div>

                                </div>

                        </td>

                        <td class="">

                            <div class="d-flex justify-content-center align-items-center" style="height:50px">
                                <div>{{ $pegi->age }}</div>
                            </div>

                        </td>


                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>

    <x-modal>
        <x-slot:deleteBtn>
            <form id="deletePegiForm" action="{{ route('admin.pegis.destroy', $pegi) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>

        </x-slot>
        <x-slot:delete>Elimina il PEGI </x-slot>
        <x-slot:wantDelete>Vuoi eliminare il PEGI?</x-slot>

    </x-modal>

    @push('scripts')
        <script>
            const deleteModal = document.getElementById('exampleModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const pegiId = button.getAttribute('data-pegi-id');
                const form = document.getElementById('deletePegiForm');
                form.action = `/admin/pegis/${pegiId}`;
            });
        </script>
    @endpush
@endsection
