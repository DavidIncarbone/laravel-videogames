 {{-- Console --}}
 <li>
     <a class="nav-link text-white d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
         href="#consolesSubmenu" role="button" aria-expanded="{{ request()->is('admin/consoles*') ? 'true' : 'false' }}">
         <span><i class="bi bi-device-hdd me-2"></i> console</span>
         <i class="bi {{ request()->is('admin/consoles*') ? 'bi-caret-down-fill' : 'bi-caret-right-fill' }}"></i>
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
