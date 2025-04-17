@extends('layouts.master')

@section('content')
    <h1 class="text-center py-5">Modifica PEGI</h1>
    <form action="{{ route('admin.pegis.update', $pegi) }}" method="POST" enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <div class="mb-3">
            <small>I campi contrassegnati con * sono obbligatori</small>
        </div>

        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="age">Modifica l'età minima*</label>
            <input type="number" name="age" id="age" value="{{ old('age', $pegi->age) }}"
                placeholder="Inserisci quì l'età minima">
            @error('age')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="logo">Inserisci l'età minima</label>
            <input type="file" name="logo" id="logo">
            @error('logo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            @if ($errors->any())
                <small class="text-warning">Seleziona di nuovo il file prima di inviare il modulo.</small>
            @endif
            @if ($pegi->logo)
                <div class="d-flex align-items-center">
                    <div>Logo attuale:</div>
                    <div id="post-image" style="width: 100px; height:50px">
                        <img id="logo" src="{{ asset('storage/' . $pegi->logo) }}" alt="{{ 'PEGI' . $pegi->age }}">
                    </div>
                </div>
            @endif
        </div>



        <input type="submit" value="Salva modifiche" class="btn btn-success">
    </form>
@endsection
