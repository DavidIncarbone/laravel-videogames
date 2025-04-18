@extends('layouts.master');

@section('content')
    <h1 class="text-center">
        Modifica Videogioco</h1>
    <x-form>

        <x-slot:route>{{ route('admin.videogames.update', $videogame) }}</x-slot>
        <x-slot:method>@method('PUT')</x-slot>
        <x-slot:name>{{ old('name', $videogame->name) }}</x-slot>
        <x-slot:console>
            <div class="form-control mb-3">
                <label for="" class="">Console</label>
                <div class="d-flex flex-wrap">
                    <div class="container">
                        <div class="row">

                            @foreach ($consoles as $console)
                                <div class="form-check d-flex align-items-center gap-3 g-3 g-lg-0 col-6 col-lg-3">
                                    <input type="checkbox" name="console_ids[]" value="{{ $console->id }}"
                                        id="console-{{ $console->id }}"
                                        {{ in_array($console->id, old('console_ids', $videogame->console_ids)) ? 'checked' : '' }}>
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


            <div class="form-control mb-3 ">

                <label>Generi</label>
                <div class="d-flex flex-wrap">
                    <div class="container">
                        <div class="row">
                            @foreach ($genres as $genre)
                                <div class="form-check d-flex align-items-center gap-3 g-3 g-lg-0 col-6 col-lg-3">
                                    <input type="checkbox" name="genre_ids[]" value="{{ $genre->id }}"
                                        id="genre-{{ $genre->id }}"
                                        {{ in_array($genre->id, old('genre_ids', $videogame->genre_ids)) ? 'checked' : '' }}>
                                    <label for="genre-{{ $genre->id }}">{{ $genre->name }}</label>
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
        <x-slot:publisher>{{ old('publisher', $videogame->publisher) }}</x-slot>
        <x-slot:year_of_publication>{{ old('year_of_publication', $videogame->year_of_publication) }}</x-slot>
        <x-slot:price>{{ $videogame->price }}</x-slot>
        <x-slot:pegi>
            @foreach ($pegis as $pegi)
                <option value="{{ $pegi->id }}"
                    {{ old('pegi_id', $videogame->pegi_id) == $pegi->id ? 'selected' : '' }}>
                    {{ $pegi->age }}</option>
            @endforeach

        </x-slot>
        <x-slot:description>{{ old('description', $videogame->description) }}</x-slot>
        <x-slot:cover>
            <div class="form-control mb-3 d-flex flex-column gap-1">
                <label for="cover">Cover del videogioco</label>
                <label for="name" id="input-info">Tipi di file consentiti: jpeg,png,jpg,webp</label>
                <input type="file" id="cover" name="cover" accept=".jpeg, .jpg, .png, .webp"
                    class="form-control bg-white">
                @error('cover')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                @if ($errors->any())
                    <small class="text-warning">Seleziona di nuovo il file prima di inviare il modulo.</small>
                @endif
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




        <x-slot:btnAction>Salva modifiche</x-slot>

    </x-form>
@endsection
