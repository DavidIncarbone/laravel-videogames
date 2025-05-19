<div class="form-control mb-3 d-flex flex-column p-3">
    <label for="publisher">Casa produttrice*</label>
    <label for="publisher" id="input-info">min. 2 max. 50 caratteri</label>
    <div class="d-flex align-items-center position-relative">
        <span class="position-absolute ps-2">
            <i class="fa-solid fa-house-laptop"></i>
        </span>
        <input type="text" name="publisher" id="publisher" value="{{ $publisher }}"
            placeholder="Inserisci quì la casa produttrice" class="form-control pr-5 bg-white ps-5 pe-5"
            oninput="toggleClearButton('publisher')" />
        <span id="clear-btn-publisher" class="position-absolute end-0 pe-3" style="cursor: pointer; display: none"
            onclick="clearInput('publisher')">
            <i class="fas fa-times"></i>
        </span>
    </div>
    <div>
        @error('publisher')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
