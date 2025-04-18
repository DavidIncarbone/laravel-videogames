@extends('layouts.master')

@section('content')
    <h1 class="text-center py-3">
        Aggiungi Videogioco</h1>

    <x-form>
        <x-slot:route>{{ route('admin.videogames.store') }}</x-slot>
        <x-slot:method></x-slot>
        <x-slot:name>{{ old('name') }}</x-slot>
        <x-slot:console>
            <div class="form-control mb-3 p-3">
                <label class="mb-3">Console*</label>
                <div class="d-flex flex-wrap">
                    <div class="container">
                        <div class="row">
                            @foreach ($consoles as $console)
                                <div class="form-check g-3 g-lg-0 gap-3 col-6 col-lg-3 d-flex align-items-center">
                                    <input type="checkbox" name="console_ids[]" value="{{ $console->id }}"
                                        id="console-{{ $console->id }}"
                                        {{ in_array($console->id, old('console_ids', [])) ? 'checked' : '' }}>
                                    <label for="console-{{ $console->id }}">{{ $console->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>


                </div>
                @error('console_ids')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </x-slot>
        <x-slot:genres>
            <div class="form-control mb-3 p-3">
                <label class="form-label mb-3">Generi*</label>
                <div class="d-flex flex-wrap">
                    <div class="container">
                        <div class="row">
                            @foreach ($genres as $genre)
                                <div class="form-check d-flex align-items-center gap-3 g-3 g-lg-0 col-6 col-lg-3">
                                    <input class=" bg-white " type="checkbox" name="genre_ids[]" value="{{ $genre->id }}"
                                        id="genre-{{ $genre->id }}"
                                        {{ in_array($genre->id, old('genre_ids', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
                <div>
                    @error('genre_ids')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </x-slot>
        <x-slot:publisher>{{ old('publisher') }}</x-slot>
        <x-slot:year_of_publication>{{ old('year_of_publication') }}</x-slot>
        <x-slot:price>{{ old('price') }}</x-slot:price>
        <x-slot:pegi>
            @foreach ($pegis as $pegi)
                <option value="{{ $pegi->id }}"{{ old('pegi_id') == $pegi->id ? 'selected' : '' }}>
                    {{ $pegi->age }}</option>
            @endforeach

        </x-slot>
        <x-slot:description>{{ old('description') }}</x-slot>
        <x-slot:cover>
            <div class="form-control mb-3 d-flex flex-column p-3">
                <label for="cover">Cover</label>
                <label for="name" id="input-info">Tipi di file consentiti: jpeg,png,jpg,webp</label>
                <input type="file" id="cover" name="cover" accept=".jpeg, .jpg, .png, .webp"
                    class="form-control bg-white">
                @error('cover')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                @if ($errors->any())
                    <small class="text-warning">Seleziona di nuovo il file prima di inviare il modulo.</small>
                @endif
            </div>
        </x-slot>

        <x-slot:btnAction>Aggiungi</x-slot>

    </x-form>
@endsection
