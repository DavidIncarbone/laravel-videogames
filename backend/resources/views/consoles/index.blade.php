@extends('layouts.master')

@section('content')
    <section id="videogames">

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

        {{-- TABLE --}}

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

                        {{-- ICONS --}}

                        <td class="d-flex align-items-center justify-content-center gap-1 " style="height:66px;">
                            <a class=" text-decoration-none text-dark" href="{{ route('admin.consoles.edit', $console) }}">
                                <i id="pencil" class="bi bi-pencil"></i>
                            </a>
                            <button type="button" class="text-decoration-none text-dark btn p-0" data-bs-toggle="modal"
                                data-bs-target="#deleteModal" data-console-id="{{ $console->id }}"
                                data-console-name='{{ $console->name }}'>
                                <i id="trash" class="bi bi-trash"></i>
                            </button>
                        </td>

                        {{-- NAME --}}

                        <td class="">
                            <div class="d-flex justify-content-around align-items-center"style=height:50px>
                                <div class="d-flex">
                                    <div style="width:150px" class="text-center">
                                        {{ $console->name }}
                                    </div>
                                </div>

                            </div>

                        </td>

                        {{-- LOGO --}}

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

        {{-- PAGINATION --}}

        <div class="pagination">
            {{ $consoles->links() }}
        </div>

    </section>

    {{-- MODAL COMPONENT --}}

    @if (count($consoles) > 0)
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
    @endif

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
@endsection
