{{-- PEGI --}}
<li>
    <a class="nav-link text-white d-flex justify-content-between align-items-center mb-2" data-bs-toggle="collapse"
        href="#pegisSubmenu" role="button" aria-expanded="{{ request()->is('admin/pegis*') ? 'true' : 'false' }}">
        <span><i class="bi bi-shield-lock me-2"></i> PEGI</span>
        <i class="bi {{ request()->is('admin/pegis*') ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
    </a>
    <div class="collapse {{ request()->is('admin/pegis*') ? 'show' : '' }}" id="pegisSubmenu">
        <div class="ps-3">
            <ul class="nav flex-column small">
                <li>
                    <a href="{{ route('admin.pegis.index') }}"
                        class="nav-link text-white mb-2 {{ $routeName === 'admin.pegis.index' ? 'active-navlink' : '' }}">
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
