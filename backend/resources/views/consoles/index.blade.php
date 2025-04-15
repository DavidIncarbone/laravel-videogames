@extends('layouts.master')

@section('content')
    <section id="videogames" class="">

        <header class="header my-3">
            <h1>Lista delle consoles</h1>
        </header>

        <div class="r">

            <a class="btn btn-primary" href="{{ route('admin.consoles.create') }}">Aggiungi console</a>

        </div>

        <table class="table table-bordered table-striped my-3 m-auto">
            <thead>
                <tr class="text-center">
                    <th>Console</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($consoles as $console)
                    <tr>
                        <td class="">
                            <div class="d-flex justify-content-around gap-3 align-items-center">
                                <div class="d-flex align-items-center gap-5">
                                    <div id="post-image" style="width: 100px; height:50px">
                                        <img id="console-logo" class="" src="{{ asset('storage/' . $console->logo) }}"
                                            alt="{{ $console->name }}">
                                    </div>
                                    <div style="width:150px">
                                        {{ $console->name }}
                                    </div>
                                </div>
                                <div>
                                    <a class="btn btn-warning"
                                        href="{{ route('admin.consoles.edit', $console) }}">Modifica</a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-console-id="{{ $console->id }}">
                                        Elimina
                                    </button>
                                </div>
                            </div>

                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>

    <x-modal>
        <x-slot:deleteBtn>
            <form id="deleteconsoleForm" action="{{ route('admin.consoles.destroy', $console) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>

        </x-slot>
        <x-slot:delete>Elimina la console </x-slot>
        <x-slot:wantDelete>Vuoi eliminare la console?</x-slot>

    </x-modal>

    @push('scripts')
        <script>
            const deleteModal = document.getElementById('exampleModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const consoleId = button.getAttribute('data-console-id');
                const form = document.getElementById('deleteconsoleForm');
                form.action = `/admin/consoles/${consoleId}`;
            });
        </script>
    @endpush
@endsection
