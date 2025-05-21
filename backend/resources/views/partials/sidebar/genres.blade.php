{{-- Generi --}}
<li>
    <a class="nav-link text-white d-flex justify-content-between align-items-center mb-3" data-bs-toggle="collapse"
        href="#genresSubmenu" role="button" aria-expanded="{{ request()->is('admin/genres*') ? 'true' : 'false' }}">
        <span>
            <i class="bi bi-tags me-2"></i>
            generi
        </span>
        @auth
            <i class="bi {{ request()->is('admin/genres*') ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
        @endauth

        @guest
            <i class="fa-solid fa-lock ms-3"></i>
        @endguest
    </a>
    @auth
        <div class="collapse {{ request()->is('admin/genres*') ? 'show' : '' }}" id="genresSubmenu">
            <div class="ps-3">
                <ul class="nav flex-column small">
                    <li>
                        <a href="{{ route('admin.genres.index') }}"
                            class="nav-link text-white mb-2 {{ $routeName === 'admin.genres.index' ? 'active-navlink' : '' }}">
                            <i class="bi bi-list-ul me-2"></i>
                            Tutti i generi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.genres.create') }}"
                            class="nav-link text-white {{ $routeName === 'admin.genres.create' ? 'active-navlink' : '' }}">
                            <i class="bi bi-plus-square me-2"></i>
                            Aggiungi genere
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endauth
</li>
