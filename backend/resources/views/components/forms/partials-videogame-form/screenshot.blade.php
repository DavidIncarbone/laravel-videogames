<div class="form-control mb-3 d-flex flex-column p-3">
    <div class="d-flex justify-content-between">
        <label for="screenshots">{{ $addEdit }} Screenshot</label>
        <button type="button" class="btn btn-danger" id="clear-screenshots" onclick="clearScreenshots()">
            Reset
        </button>
    </div>

    <label for="name" id="input-info">
        Tipi di file consentiti: jpeg,png,jpg,webp | Dimensione Max. per
        immagine: 2 MB | Max. 4 immagini
    </label>
    <input type="file" id="screenshots" name="screenshots[]" accept=".jpeg, .jpg, .png, .webp"
        class="form-control bg-white mb-3" multiple />
    <div id="new-screenshots" class="d-none">Nuovi Screenshot:</div>
    <div class="preview-container" id="previewContainer"></div>

    @error('screenshots')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    @error('screenshots.*')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    @if ($errors->any())
        <small class="text-warning">
            Seleziona di nuovo i files prima di inviare il modulo.
        </small>
    @endif

    {{ $screenshots }}
</div>
