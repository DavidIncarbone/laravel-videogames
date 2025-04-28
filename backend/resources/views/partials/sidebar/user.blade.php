  @guest
      <div class="nav-link d-flex align-items-center">
          <a class="text-decoration-none text-white w-100" href="{{ route('login') }}">
              <i class="bi bi-box-arrow-right me-2"></i> {{ __('Login') }}
          </a>
      </div>

  @endguest

  @auth
      <div class="text-white d-flex  align-items-center ms-0 ms-lg-3">

          <span class="d-none d-lg-block"> <i class="fa-solid fa-user me-2"></i>Benvenuto, {{ $user->name }}!</span>
          <a href="{{ route('admin.profile.edit') }}" class=" text-decoration-none text-white "><i
                  class="fa-solid fa-gear ms-0 ms-lg-5 fs-5 fs-lg-1"></i></a>

      </div>
  @endauth
