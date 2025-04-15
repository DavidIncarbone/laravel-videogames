@extends('layouts.master')

@section('content')
    <h1 class="text-center py-3">Modifica genere</h1>


    <form action="{{ route('admin.genres.update', $genre) }}" method="POST">

        @csrf

        @method('PUT')

        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="name">Modifica il nome del genere</label>
            <input type="text" name="name" id="name" value="{{ $genre->name }}">
        </div>

        <input type="submit" value="Salva modifiche" class="btn btn-success">
    </form>
@endsection
