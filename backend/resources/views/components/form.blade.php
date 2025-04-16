@extends('layouts.master')

@section('content')
    <form action="{{ $route }}" method="POST" enctype="multipart/form-data">

        @csrf
        {{ $method }}

        <div class="form-control mb-3 d-flex flex-column">
            <label for="name">Nome del videogioco</label>
            <input type="text" name="name" id="name" value="{{ $name }}">
        </div>
        {{ $console }}
        {{ $genres }}
        <div class="form-control mb-3 d-flex flex-column">
            <label for="publisher">Casa produttrice</label>
            <input type="text" name="publisher" id="publisher" value="{{ $publisher }}">
        </div>


        <div class="form-control mb-3 d-flex flex-column flex-md-row gap-3">
            <div class="d-flex me-3 gap-3">
                <label for="year-picker">Anno di pubblicazione</label>
                <input type="number" name="year_of_publication" id="year-picker" min="1900" max="{{ now()->year }}"
                    value="{{ $year_of_publication }}">
            </div>
            <div class="d-flex me-3">
                <label for="price" class="me-3">Prezzo</label>
                <input type="number" id="price" name="price" min="0" step="0.01" class="me-1"
                    value={{ $price }}>
                <label for="price">€</label>
            </div>
            <div class="d-flex gap-3 pb-3 pb-md-0">
                <label for="pegi">Pegi</label>
                <select name="pegi" id="pegi">
                    {{ $pegi }}
                </select>
            </div>
        </div>

        <div class="form-control mb-3 d-flex flex-column">
            <label for="summary">Descrizione</label>
            <textarea name="description" id="summary" width="100%" rows="5">{{ $description }}</textarea>
        </div>
        {{ $cover }}
        <input type="submit" value="{{ $btnAction }}" class="btn btn-success">

    </form>
@endsection
