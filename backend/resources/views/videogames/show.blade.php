@extends('layouts.master')

@section('content')
    <div class="container-fluid px-3 px-lg-5 py-4 mb-3" style="background-color:#EBEDEF;">

        <!-- Header -->
        <header class="mb-4 text-center text-lg-start">
            <div class="d-flex justify-content-between">
                <h1 class="fs-2 text-center">{{ $videogame->name }}</h1>
                <div id="icons" class="d-flex align-items-center gap-2">
                    <a class=" text-decoration-none text-dark" href="{{ route('admin.videogames.edit', $videogame) }}">
                        <i id="pencil" class="bi bi-pencil"></i>
                    </a>
                    <button type="button" class="text-decoration-none text-dark btn p-0" data-bs-toggle="modal"
                        data-bs-target="#deleteModal" data-videogame-slug="{{ $videogame->slug }}"
                        data-videogame-name="{{ $videogame->name }}">
                        <i id="trash" class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
            <p class="text-muted">Esplora i dettagli completi del videogioco.</p>
        </header>

        <!-- Videogame Details -->
        <section id="videogame-details">
            <div class="row gy-4">
                <!-- Videogame Image and Description -->
                <div class="col-12 col-lg-6">
                    <div class="w-100 mb-3" style="height:50vh;">
                        <img src="{{ asset('storage/' . $videogame->cover) }}"
                            alt="{{ Str::limit($videogame->name, 20) . '-cover' }}" class="rounded shadow-sm current-cover"
                            style="cursor:zoom-in">
                    </div>
                    <h5><strong>Descrizione:</strong></h5>
                    <p>{{ $videogame->description }}</p>
                </div>

                <!-- Videogame Info -->
                <div class="col-12 col-lg-6">


                    <div class="d-flex align-items-center gap-3 mb-4 flex-wrap">
                        <div style="width:50px; height:50px">
                            <img src="{{ asset('storage/' . $videogame->pegi->logo) }}"
                                alt="{{ 'PEGI ' . $videogame->pegi->age }}" class="img-fluid">
                        </div>
                        <div>
                            <div><strong>Casa produttrice:</strong> {{ $videogame->publisher }}</div>
                            <div><strong>Anno di uscita:</strong> {{ $videogame->year_of_publication }}</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <p><strong>Disponibile per:</strong></p>
                        <ul class="list-unstyled d-flex flex-wrap gap-5">
                            @foreach ($videogame->consoles as $console)
                                <li style="width: 75px; height: 75px;">
                                    <img src="{{ asset('storage/' . $console->logo) }}" alt="{{ $console->name }}"
                                        class="img-fluid">
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mb-3">
                        <p><strong>Genere:</strong></p>
                        <ul class="list-unstyled d-flex flex-wrap gap-1">
                            @foreach ($videogame->genres as $genre)
                                <li>{{ $genre->name }}</li>
                                @if (!$loop->last)
                                    <span class="mx-1">-</span>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                @if ($videogame->screenshots->isNotEmpty())
                    <h3>Screenshot allegati:</h3>


                    <div class="d-flex flex-wrap gap-3">
                        @foreach ($videogame->screenshots as $screenshot)
                            <div>
                                <img src="{{ asset('storage/' . $screenshot->url) }}" alt="{{ $videogame->name }}"
                                    class="current-screenshot" style="cursor:zoom-in;">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    </div>



    {{-- MODAL COMPONENT --}}


    <x-modal>
        <x-slot:delete>Elimina <span id="videogameNameToDelete" class="fw-bold text-danger"></span> </x-slot>
        <x-slot:wantDelete>Vuoi eliminare questo videogame?</x-slot>
        <x-slot:deleteBtn>
            <form id="deleteVideogameForm" action="{{ route('admin.videogames.show.destroy', $videogame->slug) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger">
            </form>

        </x-slot>
    </x-modal>

    {{-- MODAL SCRIPT --}}

    <script>
        const deleteModal = document.getElementById('deleteModal');
        // console.log(deleteModal);
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const videogameSlug = button.getAttribute('data-videogame-slug');
            const videogameName = button.getAttribute('data-videogame-name');
            const form = document.getElementById('deleteVideogameForm');
            form.action = `/admin/videogames/show/${videogameSlug}`;
            const videogameNameToDelete = document.getElementById('videogameNameToDelete');
            videogameNameToDelete.textContent = videogameName;

        });
    </script>

    {{-- OVERLAY --}}

    <x-new-cover-overlay>
        <x-slot:overlayTitle>Logo del PEGI</x-slot>
        <x-slot:img> <img src="" alt="" id="new-cover-overlay-img"
                class="rounded shadow-sm w-75 w-75">
        </x-slot>
        <x-slot:index></x-slot>
    </x-new-cover-overlay>

    <x-current-cover-overlay>
        <x-slot:overlayTitle>Cover attuale</x-slot>
        <x-slot:img> <img src="" alt="{{ $videogame->name . '-cover' }}" id="current-cover-overlay-img"
                class="rounded shadow-sm w-75 w-75">
        </x-slot>
    </x-current-cover-overlay>

    <x-new-screenshot-overlay>
        <x-slot:overlayTitle>Loghi delle console</x-slot>
        <x-slot:img> <img src="" alt="" id="new-screenshot-overlay-img"
                class="rounded shadow-sm w-75 w-75">
        </x-slot>
        <x-slot:index></x-slot>
    </x-new-screenshot-overlay>

    <x-current-screenshot-overlay>
        <x-slot:overlayTitle>Screenshot attuali</x-slot>
        <x-slot:img> <img src="" alt="" id="current-screenshot-overlay-img"
                class="rounded shadow-sm w-75 w-75">
        </x-slot>
        <x-slot:index></x-slot>
    </x-current-screenshot-overlay>
@endsection
