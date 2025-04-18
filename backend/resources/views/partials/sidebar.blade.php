@php
    $routeName = Route::currentRouteName();
@endphp

<nav class="sidebar bg-dark text-white p-2 p-lg-4">

    @include('partials.sidebar.dashboard')

    <ul class="nav flex-column">
        <div id="mobileSidebarMenu" class="d-none d-lg-block mt-lg-5 z-1020">

            @include('partials.sidebar.webApp')

            @include('partials.sidebar.videogames')
            @include('partials.sidebar.consoles')
            @include('partials.sidebar.genres')
            @include('partials.sidebar.pegis')

        </div>

        @include('partials.sidebar.logout')
    </ul>
</nav>
