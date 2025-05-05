 {{-- Logout --}}
 @auth
     <li class=" mt-3">
         {{-- <a class="nav-link text-white" href="{{ route('logout') }}"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
             <i class="bi bi-box-arrow-right me-2"></i> {{ __('Logout') }}
         </a>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
             @csrf
         </form> --}}
         <button type="button" class="nav-link text-white" data-bs-toggle="modal" data-bs-target="#logoutModal">
             <i class="bi bi-box-arrow-right me-2"></i> Logout
         </button>
     </li>
 @endauth
