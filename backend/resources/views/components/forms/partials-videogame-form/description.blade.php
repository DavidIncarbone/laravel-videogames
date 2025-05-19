<div class="form-control mb-3 d-flex flex-column p-3">
    <label for="description">Descrizione*</label>
    <label for="name" id="input-info">min. 10 max. 255 characters</label>
    <div class="d-flex align-items-center position-relative">
        <textarea name="description" id="description" width="100%" placeholder="Inserisci quì la descrizione del videogioco"
            oninput="toggleClearButton('description')" class="form-control pr-5 pe-5 bg-white">
           {{ $description }}
          </textarea>
        <span id="clear-btn-description" class="position-absolute end-0 pe-3" style="cursor: pointer; display: none"
            onclick="clearInput('description')">
            <i class="fas fa-times"></i>
        </span>
    </div>
    <div>
        @error('description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
