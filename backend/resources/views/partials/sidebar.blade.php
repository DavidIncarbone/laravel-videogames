@php
    $routeName = Route::currentRouteName();
@endphp

<nav class="sidebar bg-dark text-white p-2 p-lg-4">

    @include('partials.sidebar.dashboard')
    <div id="mobileSidebarMenu" class="d-none d-lg-block mt-lg-5 z-1020">
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
            <hr class="">


            @include('partials.sidebar.logout')
        </ul>
    </div>
</nav>
