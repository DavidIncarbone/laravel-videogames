<div class="form-control mb-3 d-flex flex-column p-3">
    <label for="cover">Cover*</label>
    <label for="name" id="input-info">
        Tipi di file consentiti: jpeg,png,jpg,webp | Max. 2 MB
    </label>
    <input type="file" id="cover" name="cover" accept=".jpeg, .jpg, .png, .webp"
        class="form-control bg-white mb-3" />
    <div id="new-cover" class="d-none">Nuova Cover:</div>
    <div class="preview-container" id="preview-cover-container"></div>
    @error('cover')
        <small class="text-danger">{{ $message }}</small>
    @enderror

    @if ($errors->any())
        <small class="text-warning">
            Seleziona di nuovo il file prima di inviare il modulo.
        </small>
    @endif

    {{ $cover }}
</div>
