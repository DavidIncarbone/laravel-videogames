 <h1 class="text-center pb-3">{{ $actionToDo }} {{ $genreName }}</h1>

 <x-errors-info></x-errors-info>

 <form id="genresForm" action="{{ $action }}" method="POST">

     @csrf
     {{ $method }}

     <div>
         <small id="form-info">I campi contrassegnati con * sono obbligatori</small>
     </div>

     {{-- NAME --}}

     <div class="form-control d-flex flex-column p-3 mb-3">
         <label for="name">Inserisci il nome del genere*</label>
         <label for="name" id="input-info">min. 2 max. 15 caratteri</label>
         <input type="text" name="name" id="name" value="{{ $name }}"
             placeholder="Inserisci qui il nome del genere" class="form-control bg-white">
         @error('name')
             <small class="text-danger">{{ $message }}</small>
         @enderror

     </div>

     <input type="submit" value="{{ $actionToDo }}" class="btn btn-success">
     <button type="button" onclick="clearForm('genresForm')" class="btn btn-danger">Svuota tutto</button>
 </form>
