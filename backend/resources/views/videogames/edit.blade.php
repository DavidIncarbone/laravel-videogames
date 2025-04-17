@extends('layouts.master');

@section('content')
    <x-form>

        <x-slot:route>{{ route('admin.videogames.update', $videogame) }}</x-slot>
        <x-slot:method>@method('PUT')</x-slot>
        <x-slot:name>{{ $videogame->name }}</x-slot>
        <x-slot:console>
            <div class="form-control mb-3">
                <label for="" class="">Console</label>
                <div class="d-flex flex-wrap">
                    @foreach ($consoles as $console)
                        <div class="tag me-2">
                            <input type="checkbox" name="console_ids[]" value="{{ $console->id }}"
                                id="console-{{ $console->id }}"
                                {{ $videogame->consoles->contains($console->id) ? 'checked' : '' }}>
                            <label for="console-{{ $console->id }}">{{ $console->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-slot>
        <x-slot:genres>
            <div class="form-control mb-3 d-flex flex-wrap">
                @foreach ($genres as $genre)
                    <div class="tag me-2">
                        <input type="checkbox" name="genre_ids[]" value="{{ $genre->id }}" id="genre-{{ $genre->id }}"
                            {{ $videogame->genres->contains($genre->id) ? 'checked' : '' }}>
                        <label for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                    </div>
                @endforeach
            </div>
        </x-slot>
        <x-slot:publisher>{{ $videogame->publisher }}</x-slot>
        <x-slot:year_of_publication>{{ $videogame->year_of_publication }}</x-slot>
        <x-slot:description>{{ $videogame->description }}</x-slot>
        <x-slot:cover>
            <div class="form-control mb-3 d-flex flex-column gap-1">
                <label for="cover">Cover del videogioco</label>
                <input type="file" id="cover" name="cover">
                @if ($videogame->cover)
                    <div class="d-flex gap-3 align-items-center mt-3">
                        <div>Cover attuale:</div>
                        <div class="" id="post-image" style="width: 100px; height:50px">
                            <img class="" src="{{ asset('storage/' . $videogame->cover) }}"
                                alt="{{ $videogame->name }}">
                        </div>
                    </div>
                @endif

            </div>
        </x-slot>
        <x-slot:price>{{ $videogame->price }}</x-slot>
        <x-slot:pegi>

            @foreach ($pegis as $pegi)
                <option value="{{ old('pegi_id', $videogame->pegi_id) === $pegi->id ? 'selected' : '' }}">
                    {{ $pegi->age }}</option>
            @endforeach

        </x-slot>



        <x-slot:btnAction>Salva modifiche</x-slot>

    </x-form>
@endsection
