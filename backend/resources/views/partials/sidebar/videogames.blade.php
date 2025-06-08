{{-- Videogiochi --}}
<li class="d-flex flex-column">
    <a class="nav-link text-white d-flex justify-content-between align-items-center mb-3" data-bs-toggle="collapse"
        href="#videogamesSubmenu" role="button"
        aria-expanded="{{ request()->is('admin/videogames*') ? 'true' : 'false' }}">
        <span>
            <i class="bi bi-controller me-2"></i>
            videogiochi
        </span>
        @auth
            <i class="bi {{ request()->is('admin/videogames*') ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
        @endauth

        @guest
            <i class="fa-solid fa-lock ms-3"></i>
        @endguest
    </a>
    @auth
        <div class="collapse {{ request()->is('admin/videogames*') || request()->is('admin/screenshots*') ? 'show' : '' }}
            "
            id="videogamesSubmenu">
            <div class="ps-3">
                <ul class="nav flex-column small">
                    <li>
                        <a href="{{ route('admin.videogames.index') }}"
                            class="nav-link text-white d-flex align-items-center mb-2 {{ $routeName === 'admin.videogames.index' ? 'active-navlink' : '' }}">
                            <div>
                                <i class="bi bi-list-ul me-2 mt-1"></i>
                            </div>
                            <div>Tutti i videogiochi</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.videogames.create') }}"
                            class="nav-link text-white d-flex align-items-center mb-2 {{ $routeName === 'admin.videogames.create' ? 'active-navlink' : '' }}">
                            <div>
                                <i class="bi bi-plus-square me-2 mt-1"></i>
                            </div>
                            <div>Aggiungi videogioco</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.screenshots.index') }}"
                            class="nav-link text-white d-flex align-items-center {{ $routeName === 'admin.screenshots.index' ? 'active-navlink' : '' }}">
                            <div><i class="fa-solid fa-images me-2"></i></div>
                            <div>Screenshot</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endauth
</li>
