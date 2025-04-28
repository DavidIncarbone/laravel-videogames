@php
    $user = auth()->user();
    $routeName = Route::currentRouteName();
@endphp

<nav class="sidebar bg-dark text-white p-2 p-lg-4">
    <div class="d-flex flex-lg-column justify-content-around  ">

        @include('partials.sidebar.dashboard')
        @include('partials.sidebar.user')

    </div>

    {{-- <hr class="d-none d-lg-block"> --}}

    <div id="mobileSidebarMenu" class="d-none d-lg-block mt-lg-4 z-1020">
        <ul class="nav flex-column">

            @include('partials.sidebar.webApp')
            <hr>

            @include('partials.sidebar.videogames')
            <hr>
            @include('partials.sidebar.consoles')
            <hr>
            @include('partials.sidebar.genres')
            <hr>
            @include('partials.sidebar.pegis')
            <hr>


            @include('partials.sidebar.logout')
        </ul>
    </div>
</nav>
