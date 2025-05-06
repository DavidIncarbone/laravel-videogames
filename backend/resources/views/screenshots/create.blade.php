@php
    $label = $remainingCount > 1 ? 'immagini' : 'immagine';
@endphp

@extends('layouts.master')

@section('content')
    <h1>Aggiungi screenshots a <span class="text-primary">{{ $videogame->name }}</span></h1>
    <form
        action="{{ route('admin.screenshots.store', 'remainingCount=' . $remainingCount, 'videogame_id=' . $videogame->id) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-control mb-3 d-flex flex-column p-3">
            <label for="screenshots">Aggiungi Screenshots</label>
            <label for="name" id="input-info">Tipi di file consentiti: jpeg,png,jpg,webp | Dimensione Max. per
                immagine: 2 MB | <span class="fw-bold text-warning">Max. {{ $remainingCount }}
                    {{ $label }}</span></label>
            <input type="file" id="screenshots" name="screenshots[]" accept=".jpeg, .jpg, .png, .webp"
                class="form-control bg-white mb-3" multiple>
            <div id="new-screenshots" class="d-none">Nuovi Screenshots:</div>
            <div class="preview-container" id="previewContainer">
            </div>
            @error('screenshots')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            @error('screenshots.*')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            @if ($errors->any())
                <small class="text-warning">Seleziona di nuovo i files prima di inviare il modulo.</small>
            @endif
            @if (count($screenshots) > 0)
                <div class="mt-3 fw-bold">Screenshots attuali <span class="fw-bold">{{ $screenshotsCount }}</span>:</div>
                <div class="d-flex flex-wrap gap-3 align-items-center my-3">
                    @foreach ($videogame->screenshots as $screenshot)
                        <div id="post-image" class="col-6 col-lg-12 g-3" style="width:100px; height:100px; cursor:zoom-in">
                            <img src="{{ asset('storage/' . $screenshot->url) }}" alt="{{ $videogame->name }}"
                                class="form-image">
                        </div>
                    @endforeach
                </div>
            @endif
            <x-overlay-img>
                <x-slot:img> <img src="{{ asset('storage/' . $videogame->cover) }}" alt="{{ $videogame->name }}"
                        id="overlay-img" class="rounded shadow-sm">
                </x-slot>
            </x-overlay-img>
        </div>

        <div>
            <input type="submit" id="submit-videogame" value="Aggiungi" class="btn btn-success">
            <button type="button" onclick="clearScreenshots()" class="btn btn-danger" id="clear-all">Svuota
                tutto</button>
        </div>
    </form>
@endsection
