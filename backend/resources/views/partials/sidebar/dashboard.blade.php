 {{-- Dashboard --}}
 <div class="sidebar-header-sticky d-flex flex-lg-column gap-4 mb-0 mb-lg-3 ">
     <div>
         <button class="btn btn-outline-light d-lg-none" type="button" id="mobileSidebarToggle">
             <i class="bi bi-list"></i>
         </button>
     </div>

     <a href="{{ route('admin.home') }}" class="text-decoration-none text-white w-100 ms-lg-3">
         <div class="d-flex align-items-center">
             <i class="bi bi-speedometer2 me-2 fs-4"></i>
             <h5 class="mb-0 text-center">Admin Dashboard</h5>
             @guest
                 <i class="fa-solid fa-lock ms-lg-3"></i>
             @endguest
         </div>
     </a>
     @include('partials.sidebar.user')
 </div>
