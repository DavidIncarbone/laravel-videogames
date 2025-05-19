<div class="d-flex justify-content-between me-3">
    <div class="d-flex flex-column w-50">
        <label for="year_of_publication" class="me-3">
            Anno di pubblicazione*
        </label>
        <label for="year_of_publication" id="input-info">
            1970 - Anno attuale
        </label>
    </div>
    <div class="d-flex flex-column position-relative">
        <div>
            <span class="position-absolute pt-2 ps-2">
                <i class="fa-solid fa-calendar-days"></i>
            </span>
            <input type="number" id="year_of_publication" name="year_of_publication" step="1"
                class="me-1 form-control bg-white ps-5" value="{{ old('year_of_publication', $year_of_publication) }}"
                placeholder="Inserisci anno" />
            <div>
                @error('year_of_publication')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>
