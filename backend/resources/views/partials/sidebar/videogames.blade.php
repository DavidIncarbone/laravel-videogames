  {{-- Videogiochi --}}
  <li>
      <a class="nav-link text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
          href="#videogamesSubmenu" role="button"
          aria-expanded="{{ request()->is('admin/videogames*') ? 'true' : 'false' }}">
          <span><i class="bi bi-controller me-2"></i> videogiochi</span>
          <i class="bi {{ request()->is('admin/videogames*') ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
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
