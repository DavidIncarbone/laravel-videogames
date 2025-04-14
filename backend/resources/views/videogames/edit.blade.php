@extends('layouts.master');

@section('content')
    <x-form>

        <x-slot:route>{{ route('admin.videogames.update', $videogame) }}</x-slot>
        <x-slot:method>@method('PUT')</x-slot>
        <x-slot:name>{{ $videogame->name }}</x-slot>
        <x-slot:type>
            @foreach ($type as $type)
                <option value="{{ $type->id }}" {{ $videogame->type_id === $type->id ? 'selected' : '' }}>
                    {{ $type->name }}</option>
            @endforeach
        </x-slot>
        <x-slot:genres>
            <div class="form-control mb-3 d-flex flex-wrap">
                @foreach ($genres as $genre)
                    <div class="tag me-2">
                        <input type="checkbox" name="genres[]" value="{{ $genre->id }}" id="genre-{{ $genre->id }}"
                            {{ $videogame->genres->contains($genre->id) ? 'checked' : '' }}>
                        <label for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                    </div>
                @endforeach
            </div>
        </x-slot>
        <x-slot:customer>{{ $videogame->customer }}</x-slot>
        <x-slot:period>{{ $videogame->period }}</x-slot>
        <x-slot:summary>{{ $videogame->summary }}</x-slot>
        <x-slot:image>
            <div class="form-control mb-3 d-flex flex-column">
                <label for="image">Immagine del videogioco</label>
                <input type="file" id="image" name="image">

                @if ($videogame->image)
                    <div class="d-flex gap-3 align-items-center mt-3">
                        <div>Immagine attuale:</div>
                        <div class="" id="post-image" style="width: 100px; height:50px">
                            <img class="" src="{{ asset('storage/' . $videogame->image) }}"
                                alt="{{ $videogame->name }}">
                        </div>
                    </div>
                @endif

            </div>
        </x-slot>
        <x-slot:link>{{ $videogame->link }}</x-slot>
        <x-slot:btnAction>Salva modifiche</x-slot>

    </x-form>
@endsection
