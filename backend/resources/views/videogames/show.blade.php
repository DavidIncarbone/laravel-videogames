@extends('layouts.master')

@section('content')
    <div class="container-fluid px-3 px-lg-5 py-4 mb-3" style="background-color: #ebedef">

        <!-- VIDEOGAME DETAILS -->

        <section id="videogame-details" class="position-relative">

            <!-- TITLE AND ICONS -->

            @include('videogames.partials-show.title-and-icons')

            <div class="row gy-4">

                <!-- IMAGE AND DESCRIPTION-->

                @include('videogames.partials-show.image-and-description')

                <!-- VIDEOGAME INFO -->
                <div class="col-12 col-lg-6">

                    {{-- PEGI - PUBLISHER - YEAR --}}

                    @include('videogames.partials-show.pegi-publisher-year')

                    {{-- CONSOLES --}}

                    @include('videogames.partials-show.consoles')

                    {{-- GENRES --}}

                    @include('videogames.partials-show.genres')
                </div>

                {{-- SCREENSHOT --}}

                @include('videogames.partials-show.screenshots')
            </div>
        </section>
    </div>

    {{-- MODAL COMPONENT --}}

    <x-modal>
        <x-slot:delete>
            Elimina
            <span id="videogameNameToDelete" class="fw-bold text-danger"></span>
        </x-slot>
        <x-slot:wantDelete>
            Vuoi eliminare questo videogame?
        </x-slot>
        <x-slot:deleteBtn>
            <form id="deleteVideogameForm" action="{{ route('admin.videogames.show.destroy', $videogame->slug) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" value="Elimina definitivamente" class="btn btn-danger" />
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
            const videogameNameToDelete = document.getElementById(
                'videogameNameToDelete',
            );
            videogameNameToDelete.textContent = videogameName;
        });
    </script>

    {{-- OVERLAYS --}}



    <x-current-cover-overlay>
        <x-slot:overlayTitle>Cover attuale</x-slot>
        <x-slot:img>
            <img src="" alt="{{ $videogame->name . '-cover' }}" id="current-cover-overlay-img"
                class="rounded shadow-sm w-75 w-75" />
        </x-slot>
    </x-current-cover-overlay>



    <x-current-screenshot-overlay>
        <x-slot:overlayTitle>Screenshot attuali</x-slot>
        <x-slot:img>
            <img src="" alt="" id="current-screenshot-overlay-img" class="rounded shadow-sm w-75 w-75" />
        </x-slot>
        <x-slot:index></x-slot>
    </x-current-screenshot-overlay>
@endsection
