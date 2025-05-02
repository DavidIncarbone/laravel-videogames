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
                <div class="d-flex gap-3 align-items-center mt-3">
                    <div>Cover attuale:</div>
                    <div id="post-image" style="width: 100px; height:100px">
                        <img src="{{ asset('storage/' . $videogame->cover) }}" alt="{{ $videogame->name }}"
                            class="form-image">
                    </div>
                </div>
            @endif
        </x-slot>
        <x-slot:screenshots>
            <div class="d-flex gap-3 align-items-center mt-3">
                <div>Screenshots attuali:</div>
                @foreach ($videogame->screenshots as $screenshot)
                    @if ($screenshot)
                        <div id="post-image" style="width: 100px; height:100px; cursor:zoom-in">
                            <img src="{{ asset('storage/' . $screenshot->url) }}" alt="{{ $videogame->name }}"
                                class="form-image">
                        </div>
                    @endif
                @endforeach
            </div>

            <div id="overlay" class="d-none">

                <div class="overlay-img-container d-flex flex-column">
                    <button type="button" id="overlay-btn" class="bg-dark text-white align-self-end"><i
                            class="fa-sharp fa-solid fa-xmark"></i> Chiudi
                    </button>
                    <div id="img-details" class="w-100 mb-3" style="height:50vh;">
                        <img src="{{ asset('storage/' . $videogame->cover) }}"
                            alt="{{ Str::limit($videogame->name, 20) }}"id="overlay-img" class="rounded shadow-sm">
                    </div>
                </div>

            </div>

            <script>
                function overlayImage() {


                    const images = document.querySelectorAll(".form-image");
                    console.log(images);
                    const overlay = document.getElementById("overlay");
                    // console.log(overlay);
                    const overlayImg = document.getElementById("overlay-img");
                    console.log(overlayImg);

                    images.forEach((image) => {
                        image.addEventListener("click", function(e) {
                            overlay.classList.toggle("d-none");
                            const imgUrl = e.target.src;
                            console.log(imgUrl);
                            overlayImg.src = imgUrl;
                        })
                    })

                    const overlayBtn = document.getElementById("overlay-btn");
                    console.log(overlayBtn);
                    overlayBtn.addEventListener("click", () => overlay.classList.toggle("d-none"));
                }
                overlayImage();
            </script>



        </x-slot>

        <x-slot:actionToDo>Modifica</x-slot>

    </x-videogame-form>
@endsection
