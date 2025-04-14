@extends('layouts.master');

@section('content')
    <x-form>


        <x-slot:route>{{ route('admin.videogames.store') }}</x-slot>
        <x-slot:method></x-slot>
        <x-slot:name></x-slot>
        <x-slot:console>
            <div class="form-control mb-3">
                <label for="" class="">Console</label>
                <div class="d-flex flex-wrap">
                    @foreach ($consoles as $console)
                        <div class="tag me-2">
                            <input type="checkbox" name="console_ids[]" value="{{ $console->id }}"
                                id="console-{{ $console->id }}">
                            <label for="console-{{ $console->id }}">{{ $console->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-slot>
        <x-slot:genres>
            <div class="form-control mb-3">
                <label for="" class="">Generi</label>
                <div class="d-flex flex-wrap">
                    @foreach ($genres as $genre)
                        <div class="tag me-2">
                            <input type="checkbox" name="genre_ids[]" value="{{ $genre->id }}"
                                id="genre-{{ $genre->id }}">
                            <label for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </x-slot>
        <x-slot:publisher></x-slot>
        <x-slot:year_of_publication>{{ now()->year }}</x-slot>
        <x-slot:price></x-slot:price>
        <x-slot:pegi>
            @foreach ($pegis as $pegi)
                <option value="{{ $pegi->id }}">{{ $pegi->age }}</option>
            @endforeach
        </x-slot>
        <x-slot:description></x-slot>
        <x-slot:image>

            <div class="form-control mb-3 d-flex flex-column">
                <label for="cover">Cover</label>
                <input type="file" id="cover" name="cover">
            </div>
        </x-slot>

        <x-slot:btnAction>Aggiungi</x-slot>

    </x-form>
@endsection
