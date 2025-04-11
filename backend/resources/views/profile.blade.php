 @extends('layouts.master')

 @section('content')
     <!-- Contenuto principale -->
     <div class="flex-grow-1 p-4">
         <div class="header d-flex justify-content-between align-items-center mb-4">
             <h1>Il tuo Profilo</h1>
             <button class="btn btn-dark">
                 <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
             </button>
         </div>

         <div class="row">
             <div class="col-md-4">
                 <div class="card">
                     <div class="card-body text-center">
                         <img src="https://via.placeholder.com/150" alt="Foto Profilo" class="rounded-circle mb-3"
                             width="150">
                         <h5 class="card-title">Nome Utente</h5>
                         <p class="card-text">Professione: Sviluppatore Web</p>
                         <button class="btn btn-warning">Modifica Profilo</button>
                     </div>
                 </div>
             </div>

             <div class="col-md-8">
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title">Informazioni Personali</h5>
                         <form>
                             <div class="mb-3">
                                 <label for="username" class="form-label">Nome utente</label>
                                 <input type="text" class="form-control" id="username" value="Nome Utente" disabled>
                             </div>
                             <div class="mb-3">
                                 <label for="email" class="form-label">Email</label>
                                 <input type="email" class="form-control" id="email" value="utente@esempio.com"
                                     disabled>
                             </div>
                             <div class="mb-3">
                                 <label for="profession" class="form-label">Professione</label>
                                 <input type="text" class="form-control" id="profession" value="Sviluppatore Web"
                                     disabled>
                             </div>
                             <div class="mb-3">
                                 <label for="bio" class="form-label">Bio</label>
                                 <textarea class="form-control" id="bio" rows="4" disabled>Appassionato di genere, sviluppo web e design. Sempre alla ricerca di nuove sfide.</textarea>
                             </div>
                             <button type="submit" class="btn btn-success">Salva Modifiche</button>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
