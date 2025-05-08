@extends('layouts.master')

@section('content')
    <x-videogame-form>

        <x-slot:videogameName><span class="fw-bold text-primary">{{ $videogame->name }}</span></x-slot>

        <x-slot:route>{{ route('admin.videogames.update', $videogame) }}</x-slot>

        <x-slot:method>@method('PUT')</x-slot>
        <x-slot:name>{{ old('name', $videogame->name) }}</x-slot>

        <x-slot:consoles>
            @foreach ($consoles as $console)
                <div class="form-check g-3 g-lg-0 gap-3 col-6 col-lg-3 d-flex align-items-center">
                    <input type="checkbox" name="console_ids[]" value="{{ $console->id }}" id="console-{{ $console->id }}"
                        {{ in_array($console->id, old('console_ids', $videogame->consoles->pluck('id')->toArray())) ? 'checked' : '' }}>
                    <label for="console-{{ $console->id }}">{{ $console->name }}</label>
                </div>
            @endforeach

        </x-slot>

        <x-slot:genres>
            @foreach ($genres as $genre)
                <div class="form-check d-flex align-items-center gap-3 g-3 g-lg-0 col-6 col-lg-3">
                    <input type="checkbox" name="genre_ids[]" value="{{ $genre->id }}" id="genre-{{ $genre->id }}"
                        {{ in_array($genre->id, old('genre_ids', $videogame->genres->pluck('id')->toArray())) ? 'checked' : '' }}>
                    <label for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                </div>
            @endforeach
        </x-slot>

        <x-slot:publisher>{{ old('publisher', $videogame->publisher) }}</x-slot>

        <x-slot:year_of_publication>{{ old('year_of_publication', $videogame->year_of_publication) }}</x-slot>

        <x-slot:price>{{ $videogame->price }}</x-slot>

        <x-slot:pegis>
            @foreach ($pegis as $pegi)
                <option value="{{ $pegi->id }}"
                    {{ old('pegi_id', $videogame->pegi_id) == $pegi->id ? 'selected' : '' }}>
                    {{ $pegi->age }}</option>
            @endforeach
        </x-slot>

        <x-slot:description>{{ old('description', $videogame->description) }}</x-slot>



        <x-slot:cover>
            @if ($videogame->cover)
                <div class="mt-3">Cover attuale:</div>
                <div class="d-flex gap-3 align-items-center mt-3">
                    <div id="post-image" style="width: 100px; height:100px">
                        <img src="{{ asset('storage/' . $videogame->cover) }}" alt="{{ $videogame->name }}"
                            class="current-cover">
                    </div>
                </div>
            @endif
        </x-slot>
        <x-slot:addEdit>Sostituisci</x-slot>
        <x-slot:screenshots>
            @if (count($videogame->screenshots) > 0)
                <div class="mt-3 fw-bold">Screenshot attuali {{ $screenshotsCount }}:</div>
                <div class="d-flex flex-wrap gap-3 align-items-center my-3">
                    @foreach ($videogame->screenshots as $screenshot)
                        <div id="post-image" class="col-6 col-lg-12 g-3" style="width:124px; height:100px; cursor:zoom-in">
                            <img src="{{ asset('storage/' . $screenshot->url) }}" alt="{{ $videogame->name }}"
                                class="current-screenshot">
                        </div>
                    @endforeach
                </div>
            @endif
        </x-slot>

        {{-- OVERLAYS --}}

        <x-slot:overlays>
            <x-new-cover-overlay>
                <x-slot:overlayTitle>Cover da aggiungere</x-slot>
                <x-slot:img> <img src="" alt="" id="new-cover-overlay-img"
                        class="rounded shadow-sm w-75 w-75">
                </x-slot>
                <x-slot:index></x-slot>
            </x-new-cover-overlay>


            <x-current-cover-overlay>
                <x-slot:overlayTitle>Cover attuale</x-slot>
                <x-slot:img> <img src="" alt="" id="current-cover-overlay-img"
                        class="rounded shadow-sm w-75 w-75">
                </x-slot>
            </x-current-cover-overlay>

            <x-new-screenshot-overlay>
                <x-slot:overlayTitle>Nuovi screenshots</x-slot>
                <x-slot:img> <img src="" alt="" id="new-screenshot-overlay-img"
                        class="rounded shadow-sm w-75 w-75">
                </x-slot>
                <x-slot:index></x-slot>
            </x-new-screenshot-overlay>

            <x-current-screenshot-overlay>
                <x-slot:overlayTitle>Screenshot attuali </x-slot>
                <x-slot:img> <img src="" alt="" id="current-screenshot-overlay-img"
                        class="rounded shadow-sm w-75 w-75">
                </x-slot>
                <x-slot:index></x-slot>
            </x-current-screenshot-overlay>


        </x-slot:overlays>

        <x-slot:actionToDo>Modifica</x-slot>

    </x-videogame-form>
@endsection
