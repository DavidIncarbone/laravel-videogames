@extends('layouts.master')

@section('content')
    <h1 class="text-center py-3">Aggiungi PEGI</h1>

    <form action="{{ route('admin.pegis.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="age">Inserisci l'età minima</label>
            <input type="number" name="age" id="age" min="1" max="100">
        </div>
        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="logo">Inserisci il logo</label>
            <input type="file" name="logo" id="logo">
        </div>

        <input type="submit" value="Aggiungi" class="btn btn-success">
    </form>
@endsection
