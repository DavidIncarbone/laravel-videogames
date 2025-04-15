@extends('layouts.master')

@section('content')
    <h1 class="text-center py-3">Aggiungi genere</h1>

    <form action="{{ route('admin.genres.store') }}" method="POST">

        @csrf

        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="name">Inserisci il nome del genere</label>
            <input type="text" name="name" id="name">
        </div>

        <input type="submit" value="Aggiungi" class="btn btn-success">
    </form>
@endsection
