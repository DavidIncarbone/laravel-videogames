@extends('layouts.master')

@section('content')
    <a href="{{ route('admin.console.index') }}" class="btn btn-primary my-3">
        < Torna alle console</a>

            <h1 class="text-center py-5">Modifica console {{ $console->name }}</h1>

            <form action="{{ route('admin.console.update', $console) }}" method="POST">

                @csrf

                @method('PUT')

                <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
                    <label for="name">Seleziona la console</label>
                    <input console="text" name="name" id="name" value="{{ $console->name }}">

                </div>
                <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
                    <label for="description">Inserisci una descrizione</label>
                    <textarea console="text" name="description" id="description" rows="5">{{ $console->description }}</textarea>
                </div>
                <input console="submit" value="Salva modifiche" class="btn btn-success">
            </form>
        @endsection
