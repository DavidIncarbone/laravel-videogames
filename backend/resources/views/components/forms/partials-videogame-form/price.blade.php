<div class="d-flex flex-column flex-lg-row gap-3">
    <div class="d-flex justify-content-between me-3">
        <div class="d-flex flex-column w-50">
            <label for="price" class="me-3">Prezzo (€)*</label>
            <label for="price" id="input-info">min. 0.01€</label>
        </div>
        <div class="d-flex flex-column">
            <div>
                <span class="position-absolute ps-2 pt-2">
                    <i class="fa-solid fa-money-check-dollar"></i>
                </span>
                <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $price) }}"
                    placeholder="Inserisci prezzo" class="form-control bg-white ps-5" />

                <div>
                    @error('price')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
