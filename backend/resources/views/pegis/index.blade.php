@extends('layouts.master')

@section('content')
    <section id="videogames" class="my-5">

        <h1 class="text-center p-3">Lista delle generi</h1>

        <a class="btn btn-primary" href="{{ route('admin.pegis.create') }}">Aggiungi PEGI</a>

        <table class="table table-bordered table-striped my-3">
            <thead>
                <tr class="text-center">
                    <th>PEGI</th>
                    <th>Opzioni</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($pegis as $pegi)
                    <tr>
                        <td class="text-center">{{ $pegi->age }}</td>

                        <td class="d-flex justify-content-center gap-3">

                            <a class="btn btn-warning" href="{{ route('admin.pegis.edit', $pegi) }}">Modifica</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" data-pegi-id="{{ $pegi->id }}">
                                Elimina
                            </button>

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
