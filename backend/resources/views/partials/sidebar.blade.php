<!-- Sidebar -->
<nav class="sidebar bg-dark text-white p-4">

    <ul class="nav flex-column">
        <li>
            <a href="{{ route('admin.home') }}" class="text-decoration-none">
                <h3 class="text-center">Admin Dashboard</h3>
            </a>
        </li>
        <li class="nav-item">
            <a href="http://localhost:5174" class="nav-link text-white">Vai al Portfolio</a>
        </li>
        {{-- <li class="nav-item">
            <a href="{{ route('admin.profile.index') }}" class="nav-link text-white">Gestisci Profilo</a>
        </li> --}}
        <li class="nav-item">
            <a href="{{ route('admin.videogames.index') }}" class="nav-link text-white">Gestisci videogiochi</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.consoles.index') }}" class="nav-link text-white">Gestisci console</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.genres.index') }}" class="nav-link text-white">Gestisci generi</a>
        </li>
        @auth
            <li class="nav-item">

                <a class="nav-link text-white" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @endauth
    </ul>
</nav>
