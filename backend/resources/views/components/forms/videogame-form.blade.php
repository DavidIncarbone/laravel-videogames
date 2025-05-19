<h2 class="pb-3">{{ $actionToDo }} {{ $videogameName }}</h2>

<x-errors-info></x-errors-info>

<form id="videogameForm" action="{{ $route }}" method="POST" enctype="multipart/form-data" class="mb-3">
    @csrf
    {{ $method }}

    <div class="mb-1">
        <small id="form-info">
            I campi contrassegnati con * sono obbligatori
        </small>
    </div>

    {{-- NAME --}}

    @include('components.forms.partials-videogame-form.name')

    {{-- CONSOLES --}}

    @include('components.forms.partials-videogame-form.consoles')

    {{-- GENRES --}}

    @include('components.forms.partials-videogame-form.genres')


    {{-- PUBLISHER --}}

    @include('components.forms.partials-videogame-form.publisher')


    <div class="form-control mb-3 d-flex flex-column flex-lg-row gap-4 gap-lg-3 p-3 pb-5 pb-lg-3">

        {{-- YEAR OF PUBLICATION --}}

        @include('components.forms.partials-videogame-form.year-of-publication')

        {{-- PRICE --}}

        @include('components.forms.partials-videogame-form.price')

        {{-- PEGIS --}}

        @include('components.forms.partials-videogame-form.pegis')
    </div>

    {{-- DESCRIPTION --}}

    @include('components.forms.partials-videogame-form.description')

    {{-- COVER --}}

    @include('components.forms.partials-videogame-form.cover')

    {{-- SCREENSHOT --}}

    @include('components.forms.partials-videogame-form.screenshot')

    {{ $overlays }}

    <div>
        <input type="submit" id="submit-videogame" value="{{ $actionToDo }}" class="btn btn-success" />
        <button type="button" onclick="clearVideogameForm()" class="btn btn-danger">
            Svuota tutto
        </button>
    </div>
</form>
