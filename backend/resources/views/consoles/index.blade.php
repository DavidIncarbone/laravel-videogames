@extends('layouts.master')

@section('content')
    <section id="videogames" class="">

        <header class="header my-3">

            <h1 class="">Lista delle consoles</h1>
        </header>
        <table class="table table-bordered table-striped my-3 m-auto">
            <thead>
                <tr class="text-center">
                    <th></th>
                    <th>Console</th>
                    <th>Logo</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($consoles as $console)
                    <tr>

                        <td class="d-flex align-items-center justify-content-center gap-1 " style="height:66px;">
                            <a class=" text-decoration-none text-dark" href="{{ route('admin.consoles.edit', $console) }}">
                                <i id="pencil" class="bi bi-pencil"></i>
                            </a>
                            <button type="button" class="text-decoration-none text-dark btn p-0" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" data-console-id="{{ $console->id }}">
                                <i id="trash" class="bi bi-trash"></i>
                            </button>
                        </td>

                        <td>
                            <div class="d-flex justify-content-around gap-3 align-items-center">
                                <div class="d-flex align-items-center gap-5">

                                    <div style="width:150px" class="text-center">
                                        {{ $console->name }}
                                    </div>
                                </div>

                            </div>

                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <div id="post-image" style="width: 100px; height:50px">
                                    <img id="logo" class="" src="{{ asset('storage/' . $console->logo) }}"
                                        alt="{{ $console->name }}">
                                </div>
                            </div>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="pagination">
            {{ $consoles->links() }}
        </div>

    </section>

    <x-modal>
        <x-slot:deleteBtn>
            <form id="deleteConsoleForm" action="{{ route('admin.consoles.destroy', $console) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>

        </x-slot>
        <x-slot:delete>Elimina la console </x-slot>
        <x-slot:wantDelete>Vuoi eliminare la console?</x-slot>

    </x-modal>


    <script>
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const consoleId = button.getAttribute('data-console-id');
            const form = document.getElementById('deleteConsoleForm');
            form.action = `/admin/consoles/${consoleId}`;
        });
    </script>
@endsection
