@extends('layouts.master')

@section('content')
    <h1 class="text-center py-5">Modifica PEGI</h1>
    <form action="{{ route('admin.pegis.update', $pegi) }}" method="POST" enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="age">Modifica l'età minima</label>
            <input type="number" name="age" id="age" min="1" max="100" value="{{ $pegi->age }}">
        </div>
        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="logo">Inserisci l'età minima</label>
            <input type="file" name="logo" id="logo">
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
