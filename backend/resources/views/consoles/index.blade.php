@extends('layouts.master')

@section('content')
    <section id="videogames" class="my-5">

        <h1 class="text-center p-3">Lista delle consoles</h1>

        <a class="btn btn-primary" href="{{ route('admin.consoles.create') }}">Aggiungi console</a>

        <table class="table table-bordered table-striped my-3">
            <thead>
                <tr class="text-center">
                    <th>Console</th>

                    <th>Opzioni</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($consoles as $console)
                    <tr>
                        <td class="text-center">{{ $console->name }}</td>

                        <td class="d-flex justify-content-center gap-3">

                            <a class="btn btn-warning" href="{{ route('admin.consoles.edit', $console) }}">Modifica</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
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
            <form action="{{ route('admin.consoles.destroy', $console) }}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>
            <x-slot:delete>Elimina la console </x-slot>
            <x-slot:wantDelete>Vuoi eliminare la console?</x-slot>

        </x-slot>

    </x-modal>
@endsection
