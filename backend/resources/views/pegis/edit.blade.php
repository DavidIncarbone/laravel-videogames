@extends('layouts.master')

@section('content')
    <h1 class="text-center py-5">Modifica PEGI</h1>
    <form action="{{ route('admin.pegis.update', $pegi) }}" method="POST">

        @csrf

        @method('PUT')

        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="age">Inserisci l'età minima</label>
            <input type="number" name="age" id="age" min="1" max="100" value="{{ $pegi->age }}">
        </div>

        <input type="submit" value="Salva modifiche" class="btn btn-success">
    </form>
@endsection
