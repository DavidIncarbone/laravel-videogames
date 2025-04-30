@extends('layouts.master')

@section('content')
    <x-videogame-form>
        <x-slot:videogameName>Videogioco</x-slot>
        <x-slot:route>{{ route('admin.videogames.store') }}</x-slot>
        <x-slot:method></x-slot>

        <x-slot:name>{{ old('name') }}</x-slot>

        <x-slot:consoles>
            @if (count($consoles) < 1)
                <p>Nessuna console presente</p>
            @else
                @foreach ($consoles as $console)
                    <div class="form-check g-3 g-lg-0 gap-3 col-6 col-lg-3 d-flex align-items-center">
                        <input type="checkbox" name="console_ids[]" value="{{ $console->id }}" id="console-{{ $console->id }}"
                            {{ in_array($console->id, old('console_ids', [])) ? 'checked' : '' }}>
                        <label for="console-{{ $console->id }}">{{ $console->name }}</label>
                    </div>
                @endforeach
            @endif
        </x-slot>


        <x-slot:genres>
            @if (count($genres) < 1)
                <p>Nessun genere presente</p>
            @else
                @foreach ($genres as $genre)
                    <div class="form-check d-flex align-items-center gap-3 g-3 g-lg-0 col-6 col-lg-3">
                        <input class=" bg-white " type="checkbox" name="genre_ids[]" value="{{ $genre->id }}"
                            id="genre-{{ $genre->id }}"
                            {{ in_array($genre->id, old('genre_ids', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                    </div>
                @endforeach
            @endif
        </x-slot>

        <x-slot:publisher>{{ old('publisher') }}</x-slot>

        <x-slot:year_of_publication>{{ old('year_of_publication') }}</x-slot>

        <x-slot:price>{{ old('price') }}</x-slot:price>

        <x-slot:pegis>
            @if (count($pegis) < 1)
                <option value="" selected disabled>Nessun PEGI presente</option>
            @else
                <option value="" selected disabled>Seleziona PEGI</option>
                @foreach ($pegis as $pegi)
                    <option value="{{ $pegi->id }}"{{ old('pegi_id') == $pegi->id ? 'selected' : '' }}>
                        {{ $pegi->age }}</option>
                @endforeach
            @endif
        </x-slot>

        <x-slot:description>{{ old('description') }}</x-slot>

        <x-slot:cover></x-slot>
        <x-slot:screenshots></x-slot>

        <x-slot:actionToDo>Aggiungi</x-slot>

    </x-videogame-form>
@endsection
