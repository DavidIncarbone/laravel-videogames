@extends('layouts.master')

@section('content')
    <a href="{{ route('admin.type.index') }}" class="btn btn-primary my-3">
        < Torna alle type</a>

            <h1 class="text-center py-5">Modifica type {{ $type->name }}</h1>

            <form action="{{ route('admin.type.update', $type) }}" method="POST">

                @csrf

                @method('PUT')

                <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
                    <label for="name">Seleziona la type</label>
                    <input type="text" name="name" id="name" value="{{ $type->name }}">

                </div>
                <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
                    <label for="description">Inserisci una descrizione</label>
                    <textarea type="text" name="description" id="description" rows="5">{{ $type->description }}</textarea>
                </div>
                <input type="submit" value="Salva modifiche" class="btn btn-success">
            </form>
        @endsection
