<div class="form-control mb-3 p-3">
    <div class="d-flex gap-3 justify-content-between mb-3">
        <label class="mb-3" for="allGenres">Generi*</label>
        <div class="form-check d-flex align-items-center gap-1">
            <div class="btn btn-secondary" onclick="selectAll('genre_ids\\[\\]')">
                Seleziona tutti
            </div>
            <div class="btn btn-danger" onclick="resetAll('genre_ids\\[\\]')">
                Reset
            </div>
        </div>
    </div>
    <div class="d-flex flex-wrap">
        <div class="container">
            <div class="row">
                {{ $genres }}
            </div>
        </div>
    </div>
    <div class="ms-4 mt-1">
        @error('genre_ids')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
