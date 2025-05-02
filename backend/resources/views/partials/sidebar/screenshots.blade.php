 {{-- screenshot --}}
 <li>
     <a class="nav-link text-white d-flex justify-content-between align-items-center mb-2" data-bs-toggle="collapse"
         href="#screenshotsSubmenu" role="button"
         aria-expanded="{{ request()->is('admin/screenshots*') ? 'true' : 'false' }}">
         <span><i class="fa-solid fa-images me-2"></i>screenshots</span>
         @auth
             <i class="bi {{ request()->is('admin/screenshots*') ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
         @endauth
         @guest
             <i class="fa-solid fa-lock ms-3"></i>
         @endguest
     </a>
     @auth
         <div class="collapse {{ request()->is('admin/screenshots*') ? 'show' : '' }}" id="screenshotsSubmenu">
             <div class="ps-3">
                 <ul class="nav flex-column small">
                     <li>
                         <a href="{{ route('admin.screenshots.index') }}"
                             class="nav-link text-white d-flex align-items-center mb-2 {{ $routeName === 'admin.screenshots.index' ? 'active-navlink' : '' }}">
                             <div><i class="bi bi-list-ul me-2 mt-1"></i></div>
                             <div>Tutti gli screenshots</div>
                         </a>
                     </li>
                 </ul>
             </div>
         </div>
     @endauth
 </li>
