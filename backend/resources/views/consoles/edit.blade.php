@extends('layouts.master')

@section('content')
    <a href="{{ route('admin.consoles.index') }}" class="btn btn-primary my-3">
        < Torna alle console</a>

            <h1 class="text-center py-5">Modifica {{ $console->name }}</h1>

            <form action="{{ route('admin.consoles.update', $console) }}" method="POST">

                @csrf

                @method('PUT')

                <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
                    <label for="name">Seleziona la type</label>
                    <input type="text" name="name" id="name" value="{{ $console->name }}">

                </div>

                <input type="submit" value="Salva modifiche" class="btn btn-success">
            </form>
        @endsection
