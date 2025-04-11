@extends('layouts.master')

@section('content')
    <div><a href="{{ route('admin.genres.index') }}" class="btn btn-primary my-3">
            < Torna alle generi</a>
    </div>


    <h1 class="text-center py-5">Aggiungi genere</h1>

    <form action="{{ route('admin.genres.store') }}" method="POST">

        @csrf

        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="name">Inserisci il nome della genere</label>
            <input type="text" name="name" id="name">
        </div>
        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="description">Inserisci una descrizione</label>
            <textarea type="text" name="description" id="description" rows="5"></textarea>
        </div>
        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3" style="width: 250px">
            <label for="color">Scegli il colore del badge</label>
            <input class="w-75" type="color" name="color" id="color">
        </div>

        <input type="submit" value="Aggiungi" class="btn btn-success">
    </form>
@endsection
