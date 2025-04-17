@extends('layouts.master')

@section('content')
    <header class="header my-3">
        <h1>Lista dei videogiochi</h1>
    </header>

    <section id="videogames" class="my-3">
        <table class="table table-bordered table-striped">
            <thead class="">
                <tr class="text-center">
                    <th></th>
                    <th>Nome videogioco</th>
                    <th>Console</th>
                    <th>Anno di uscita</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($videogames as $videogame)
                    <tr>
                        <td>
                            <div id="icons" class="d-flex align-items-center justify-content-around">
                                <a href="{{ route('admin.videogames.show', $videogame) }}"
                                    class="text-decoration-none text-dark d-flex align-items-center">
                                    <i id="eye" class="bi bi-eye"></i>
                                </a>

                                <a class=" text-decoration-none text-dark"
                                    href="{{ route('admin.videogames.edit', $videogame) }}">
                                    <i id="pencil" class="bi bi-pencil"></i>
                                </a>

                                <button type="button" class="text-decoration-none text-dark btn p-0" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" data-videogame-id="{{ $videogame->id }}">
                                    <i id="trash" class="bi bi-trash"></i>
                                </button>
                            </div>


                        </td>
                        <td>{{ $videogame->name }}</td>
                        <td>

                            @foreach ($videogame->consoles as $console)
                                {{ $console->name }}


                                @if (!$loop->last)
                                    <span id="comma">,</span>
                                @endif
                            @endforeach
                        <td class="text-center">

                            {{ $videogame->year_of_publication }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </section>

    <x-modal>
        <x-slot:deleteBtn>
            <form id="deletevideogameForm" action="{{ route('admin.videogames.destroy', $videogame) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>

        </x-slot>
        <x-slot:delete>Elimina il videogioco </x-slot>
        <x-slot:wantDelete>Vuoi eliminare il videogioco?</x-slot>

    </x-modal>


    <script>
        const deleteModal = document.getElementById('exampleModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const videogameId = button.getAttribute('data-videogame-id');
            const form = document.getElementById('deletevideogameForm');
            form.action = `/admin/videogames/${videogameId}`;
        });
    </script>
@endsection
