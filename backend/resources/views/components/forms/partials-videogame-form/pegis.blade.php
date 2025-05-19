<div class="d-flex gap-0 gap-lg-3">
    <div>
        <label for="pegi">Pegi*</label>
    </div>
    <div id="pegi" class="d-flex flex-column">
        <div id="pegi-select">
            <select name="pegi_id" id="pegi_id" class="form-select bg-white">
                {{ $pegis }}
            </select>
            <div class="d-flex justify-content-end">
                @error('pegi_id')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror
            </div>
        </div>
    </div>
</div>
</div>
