@extends('layouts.master')

@section('content')
    <x-videogame-form>
        <x-slot:videogameName>Videogioco</x-slot>
        <x-slot:route>{{ route('admin.videogames.store') }}</x-slot>
        <x-slot:method></x-slot>

        <x-slot:name>{{ old('name') }}</x-slot>

        <x-slot:consoles>
            @foreach ($consoles as $console)
                <div class="form-check g-3 g-lg-0 gap-3 col-6 col-lg-3 d-flex align-items-center">
                    <input type="checkbox" name="console_ids[]" value="{{ $console->id }}" id="console-{{ $console->id }}"
                        {{ in_array($console->id, old('console_ids', [])) ? 'checked' : '' }}>
                    <label for="console-{{ $console->id }}">{{ $console->name }}</label>
                </div>
            @endforeach
        </x-slot>

        <x-slot:genres>
            @foreach ($genres as $genre)
                <div class="form-check d-flex align-items-center gap-3 g-3 g-lg-0 col-6 col-lg-3">
                    <input class=" bg-white " type="checkbox" name="genre_ids[]" value="{{ $genre->id }}"
                        id="genre-{{ $genre->id }}" {{ in_array($genre->id, old('genre_ids', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                </div>
            @endforeach
        </x-slot>

        <x-slot:publisher>{{ old('publisher') }}</x-slot>

        <x-slot:year_of_publication>{{ old('year_of_publication') }}</x-slot>

        <x-slot:price>{{ old('price') }}</x-slot:price>

        <x-slot:pegis>
            @foreach ($pegis as $pegi)
                <option value="{{ $pegi->id }}"{{ old('pegi_id') == $pegi->id ? 'selected' : '' }}>
                    {{ $pegi->age }}</option>
            @endforeach
        </x-slot>

        <x-slot:description>{{ old('description') }}</x-slot>

        <x-slot:cover></x-slot>

        <x-slot:actionToDo>Aggiungi</x-slot>

    </x-videogame-form>
@endsection
