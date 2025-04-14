@extends('layouts.master')

@section('content')
    <h1 class="text-center py-5">Aggiungi PEGI</h1>

    <form action="{{ route('admin.pegis.store') }}" method="POST">

        @csrf

        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="age">Inserisci l'età minima</label>
            <input type="number" name="age" id="age" min="1" max="100">
        </div>

        <input type="submit" value="Aggiungi" class="btn btn-success">
    </form>
@endsection
