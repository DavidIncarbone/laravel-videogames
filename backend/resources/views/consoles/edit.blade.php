@extends('layouts.master')

@section('content')
    <h1 class="text-center py-5">Modifica {{ $console->name }}</h1>

    <form action="{{ route('admin.consoles.update', $console) }}" method="POST" enctype="multipart/form-data">

        @csrf

        @method('PUT')

        <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
            <label for="name">Modifica il nome della console</label>
            <input type="text" name="name" id="name" value="{{ $console->name }}">
        </div>
        <div class="form-control d-flex flex-column gap-2 mb-3">
            <label for="logo">Modifica il logo</label>
            <input type="file" name="logo" id="logo">
            @if ($console->logo)
                <div class="d-flex gap-3 align-items-center">
                    <div>Logo attuale:</div>
                    <div class="" id="post-image" style="width: 100px; height:50px">
                        <img id="console-logo" class="" src="{{ asset('storage/' . $console->logo) }}"
                            alt="{{ $console->name }}">
                    </div>
                </div>
            @endif
        </div>

        <input type="submit" value="Salva modifiche" class="btn btn-success">
    </form>
@endsection
