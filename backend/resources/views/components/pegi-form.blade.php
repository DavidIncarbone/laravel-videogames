  <h1 class="text-center pb-3">{{ $actionToDo }} {{ $pegiAge }}</h1>

  <x-errors-info></x-errors-info>

  <form id="pegiForm" action="{{ $action }}" method="POST" enctype="multipart/form-data">
      @csrf
      {{ $method }}
      <div>
          <small id="form-info">I campi contrassegnati con * sono obbligatori</small>
      </div>

      {{-- NAME --}}

      <div class="form-control d-flex flex-column p-3 mb-3">
          <label for="age">Inserisci l'età minima*</label>
          <label for="name" id="input-info">min. 1 max. 100</label>
          <input type="number" name="age" id="age" step="1" style="width:200px"
              value="{{ $age }}" placeholder="Inserisci quì l'età minima" class="form-control bg-white">
          @error('age')
              <small class="text-danger">{{ $message }}</small>
          @enderror
      </div>

      {{-- COVER --}}

      <div class="form-control d-flex flex-column  p-3 mb-3">
          <label for="logo">Inserisci il logo*</label>
          <label for="name" id="input-info">Tipi di file consentiti: jpeg,png,jpg,webp</label>
          <input type="file" name="logo" id="cover" accept=".jpeg, .jpg, .png, .webp"
              class="form-control bg-white mb-3">
          <div id="new-cover" class="d-none">Nuovo logo:</div>
          <div class="preview-container" id="preview-cover-container">
          </div>

          @error('logo')
              <small class="text-danger">{{ $message }}</small>
          @enderror
          @if ($errors->any())
              <small class="text-warning">Seleziona di nuovo il file prima di inviare il modulo.</small>
          @endif
          {{ $logo }}
          {{ $overlays }}
      </div>

      <input type="submit" value="{{ $actionToDo }}" class="btn btn-success">
      <button type="button" onclick="clearForm('pegiForm')" class="btn btn-danger">Svuota tutto</button>

  </form>
