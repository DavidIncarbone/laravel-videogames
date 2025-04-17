@php
    $routeName = Route::currentRouteName();
@endphp

<nav class="sidebar bg-dark text-white p-2 p-lg-4">

    {{-- Dashboard --}}
    <div class="sidebar-header-sticky d-flex align-items-center gap-3 mb-0 mb-lg-3">
        <div>
            <button class="btn btn-outline-light d-lg-none" type="button" id="mobileSidebarToggle">
                <i class="bi bi-list"></i>
            </button>
        </div>

        <a href="{{ route('admin.home') }}" class="text-decoration-none text-white w-100">
            <div class="d-flex justify-content-center align-items-center">
                <i class="bi bi-speedometer2 me-2 fs-4"></i>
                <h3 class="mb-0 w-100">Admin Dashboard</h3>
            </div>
        </a>
    </div>

    <ul class="nav flex-column">
        <div id="mobileSidebarMenu" class="d-none d-lg-block mt-lg-5 z-1020">

            {{-- Portfolio --}}
            <li>
                <a href="http://localhost:5174" class="nav-link text-white">
                    <i class="bi bi-box-arrow-up-right me-2"></i> Vai al Portfolio
                </a>
            </li>

            {{-- Videogiochi --}}
            <li>
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" href="#videogamesSubmenu" role="button"
                    aria-expanded="{{ request()->is('admin/videogames*') ? 'true' : 'false' }}">
                    <span><i class="bi bi-controller me-2"></i> videogiochi</span>
                    <i
                        class="bi {{ request()->is('admin/videogames*') ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
                </a>
                <div class="collapse {{ request()->is('admin/videogames*') ? 'show' : '' }}" id="videogamesSubmenu">
                    <div class="ps-3">
                        <ul class="nav flex-column small">
                            <li>
                                <a href="{{ route('admin.videogames.index') }}"
                                    class="nav-link text-white d-flex {{ $routeName === 'admin.videogames.index' ? 'active-navlink' : '' }}">
                                    <i class="bi bi-list-ul me-2 mt-1"></i>
                                    <div>Tutti i videogiochi</div>
                                </a>
                            </li>
                            <li>
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
            <li>
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" href="#consolesSubmenu" role="button"
                    aria-expanded="{{ request()->is('admin/consoles*') ? 'true' : 'false' }}">
                    <span><i class="bi bi-device-hdd me-2"></i> console</span>
                    <i
                        class="bi {{ request()->is('admin/consoles*') ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
                </a>
                <div class="collapse {{ request()->is('admin/consoles*') ? 'show' : '' }}" id="consolesSubmenu">
                    <div class="ps-3">
                        <ul class="nav flex-column small">
                            <li>
                                <a href="{{ route('admin.consoles.index') }}"
                                    class="nav-link text-white d-flex {{ $routeName === 'admin.consoles.index' ? 'active-navlink' : '' }}">
                                    <i class="bi bi-list-ul me-2 mt-1"></i>
                                    <div>Tutte le consoles</div>
                                </a>
                            </li>
                            <li>
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
            <li>
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" href="#genresSubmenu" role="button"
                    aria-expanded="{{ request()->is('admin/genres*') ? 'true' : 'false' }}">
                    <span><i class="bi bi-tags me-2"></i> generi</span>
                    <i
                        class="bi {{ request()->is('admin/genres*') ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
                </a>
                <div class="collapse {{ request()->is('admin/genres*') ? 'show' : '' }}" id="genresSubmenu">
                    <div class="ps-3">
                        <ul class="nav flex-column small">
                            <li>
                                <a href="{{ route('admin.genres.index') }}"
                                    class="nav-link text-white {{ $routeName === 'admin.genres.index' ? 'active-navlink' : '' }}">
                                    <i class="bi bi-list-ul me-2"></i> Tutti i generi
                                </a>
                            </li>
                            <li>
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
            <li>
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse" href="#pegisSubmenu" role="button"
                    aria-expanded="{{ request()->is('admin/pegis*') ? 'true' : 'false' }}">
                    <span><i class="bi bi-shield-lock me-2"></i> PEGI</span>
                    <i
                        class="bi {{ request()->is('admin/pegis*') ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
                </a>
                <div class="collapse {{ request()->is('admin/pegis*') ? 'show' : '' }}" id="pegisSubmenu">
                    <div class="ps-3">
                        <ul class="nav flex-column small">
                            <li>
                                <a href="{{ route('admin.pegis.index') }}"
                                    class="nav-link text-white {{ $routeName === 'admin.pegis.index' ? 'active-navlink' : '' }}">
                                    <i class="bi bi-list-ul me-2"></i> Tutti i PEGI
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.pegis.create') }}"
                                    class="nav-link text-white {{ $routeName === 'admin.pegis.create' ? 'active-navlink' : '' }}">
                                    <i class="bi bi-plus-square me-2"></i> Aggiungi PEGI
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </div>

        {{-- Logout --}}
        @auth
            <li class=" mt-3">
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
    // TOGGLE ICONS
    document.addEventListener('DOMContentLoaded', function() {
        const collapseElements = document.querySelectorAll('.collapse');
        collapseElements.forEach(collapse => {
            const icons = collapse.previousElementSibling.querySelectorAll('i.bi');
            const toggleIcon = icons[icons.length - 1];
            // console.log(toggleIcon);

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

        // MOBILE HAM MENU

        const toggleBtn = document.getElementById('mobileSidebarToggle');
        const mobileMenu = document.getElementById('mobileSidebarMenu');
        // console.log(mobileMenu);

        toggleBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('d-none');
        });
    });
</script>
