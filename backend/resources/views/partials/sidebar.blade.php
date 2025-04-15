@php
    $routeName = Route::currentRouteName();
@endphp

<nav class="sidebar bg-dark text-white p-4 overflow-y-auto">
    <ul class="nav flex-column">
        {{-- Dashboard --}}
        <li>
            <a href="{{ route('admin.home') }}" class="text-decoration-none">
                <h3 class="text-center">
                    <i class="bi bi-speedometer2 me-2"></i> Admin Dashboard
                </h3>
            </a>
        </li>

        {{-- Portfolio --}}
        <li class="nav-item">
            <a href="http://localhost:5174" class="nav-link text-white">
                <i class="bi bi-box-arrow-up-right me-2"></i> Vai al Portfolio
            </a>
        </li>

        {{-- Videogiochi --}}
        <li class="nav-item">
            <a class="nav-link text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#videogamesSubmenu" role="button"
                aria-expanded="{{ request()->is('admin/videogames*') ? 'true' : 'false' }}">
                <span><i class="bi bi-controller me-2"></i> videogiochi</span>
                <i
                    class="bi {{ request()->is('admin/videogames*') ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
            </a>
            <div class="collapse {{ request()->is('admin/videogames*') ? 'show' : '' }}" id="videogamesSubmenu">
                <div class="ps-3">
                    <ul class="nav flex-column small">
                        <li class="nav-item">
                            <a href="{{ route('admin.videogames.index') }}"
                                class="nav-link text-white d-flex{{ $routeName === 'admin.videogames.index' ? 'active-navlink' : '' }}">
                                <i class="bi bi-list-ul me-2 mt-1"></i>
                                <div>Tutti i videogiochi</div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.videogames.create') }}"
                                class="nav-link text-white d-flex {{ $routeName === 'admin.videogames.create' ? 'active-navlink' : '' }}">
                                <i class="bi bi-plus-square me-2 mt-1"></i>
                                <div>Aggiungi videogioco</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>

        {{-- Console --}}
        <li class="nav-item">
            <a class="nav-link text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#consolesSubmenu" role="button"
                aria-expanded="{{ request()->is('admin/consoles*') ? 'true' : 'false' }}">
                <span><i class="bi bi-device-hdd me-2"></i> console</span>
                <i class="bi {{ request()->is('admin/consoles*') ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
            </a>
            <div class="collapse {{ request()->is('admin/consoles*') ? 'show' : '' }}" id="consolesSubmenu">
                <div class="ps-3">
                    <ul class="nav flex-column small">
                        <li class="nav-item">
                            <a href="{{ route('admin.consoles.index') }}"
                                class="nav-link text-white d-flex {{ $routeName === 'admin.consoles.index' ? 'active-navlink' : '' }}">
                                <i class="bi bi-list-ul me-2 mt-1"></i>
                                <div>Tutte le consoles</div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.consoles.create') }}"
                                class="nav-link text-white d-flex {{ $routeName === 'admin.consoles.create' ? 'active-navlink' : '' }}">
                                <i class="bi bi-plus-square me-2 mt-1"></i>
                                <span>Aggiungi console</span>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>

        {{-- Generi --}}
        <li class="nav-item">
            <a class="nav-link text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#genresSubmenu" role="button"
                aria-expanded="{{ request()->is('admin/genres*') ? 'true' : 'false' }}">
                <span><i class="bi bi-tags me-2"></i> generi</span>
                <i class="bi {{ request()->is('admin/genres*') ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
            </a>
            <div class="collapse {{ request()->is('admin/genres*') ? 'show' : '' }}" id="genresSubmenu">
                <div class="ps-3">
                    <ul class="nav flex-column small">
                        <li class="nav-item">
                            <a href="{{ route('admin.genres.index') }}"
                                class="nav-link text-white {{ $routeName === 'admin.genres.index' ? 'active-navlink' : '' }}">
                                <i class="bi bi-list-ul me-2"></i> Tutti i generi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.genres.create') }}"
                                class="nav-link text-white {{ $routeName === 'admin.genres.create' ? 'active-navlink' : '' }}">
                                <i class="bi bi-plus-square me-2"></i> Aggiungi genere
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>

        {{-- PEGI --}}
        <li class="nav-item">
            <a class="nav-link text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                href="#pegisSubmenu" role="button"
                aria-expanded="{{ request()->is('admin/pegis*') ? 'true' : 'false' }}">
                <span><i class="bi bi-shield-lock me-2"></i> PEGI</span>
                <i class="bi {{ request()->is('admin/pegis*') ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
            </a>
            <div class="collapse {{ request()->is('admin/pegis*') ? 'show' : '' }}" id="pegisSubmenu">
                <div class="ps-3">
                    <ul class="nav flex-column small">
                        <li class="nav-item">
                            <a href="{{ route('admin.pegis.index') }}"
                                class="nav-link text-white {{ $routeName === 'admin.pegis.index' ? 'active-navlink' : '' }}">
                                <i class="bi bi-list-ul me-2"></i> Tutti i PEGI
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.pegis.create') }}"
                                class="nav-link text-white {{ $routeName === 'admin.pegis.create' ? 'active-navlink' : '' }}">
                                <i class="bi bi-plus-square me-2"></i> Aggiungi PEGI
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </li>

        {{-- Logout --}}
        @auth
            <li class="nav-item mt-3">
                <a class="nav-link text-white" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @endauth
    </ul>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const collapseElements = document.querySelectorAll('.collapse');

        collapseElements.forEach(collapse => {
            const icons = collapse.previousElementSibling.querySelectorAll('i.bi');
            const toggleIcon = icons[icons.length - 1];

            if (!toggleIcon) return;

            collapse.addEventListener('show.bs.collapse', function() {
                toggleIcon.classList.remove('bi-caret-right-fill');
                toggleIcon.classList.add('bi-caret-down-fill');
            });

            collapse.addEventListener('hide.bs.collapse', function() {
                toggleIcon.classList.remove('bi-caret-down-fill');
                toggleIcon.classList.add('bi-caret-right-fill');
            });

            if (collapse.classList.contains('show')) {
                toggleIcon.classList.remove('bi-caret-right-fill');
                toggleIcon.classList.add('bi-caret-down-fill');
            }
        });
    });
</script>
