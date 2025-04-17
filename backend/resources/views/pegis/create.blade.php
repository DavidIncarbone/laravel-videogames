@extends('layouts.master')

@section('content')
    <h1 class="text-center py-3">Aggiungi PEGI</h1>

    <form action="{{ route('admin.pegis.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <small>I campi contrassegnati con * sono obbligatori</small>
        </div>

        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="age">Inserisci l'età minima*</label>
            <input type="number" name="age" id="age" step="1" style="width:190px" value="{{ old('age') }}"
                placeholder="Inserisci quì l'età minima">
            @error('age')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="logo">Inserisci il logo</label>
            <input type="file" name="logo" id="logo">
            @error('logo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            @if ($errors->any())
                <small class="text-warning">Seleziona di nuovo il file prima di inviare il modulo.</small>
            @endif
        </div>

        <input type="submit" value="Aggiungi" class="btn btn-success">
    </form>
@endsection
