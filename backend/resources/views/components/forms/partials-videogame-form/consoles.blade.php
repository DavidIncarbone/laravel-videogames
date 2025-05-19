<div class="form-control mb-3 p-3">
    <div class="d-flex gap-3 justify-content-between">
        <label class="mb-3" for="allConsoles">Console*</label>
        <div class="form-check d-flex align-items-center gap-1 mb-3">
            <div class="btn btn-secondary" onclick="selectAll('console_ids\\[\\]')">
                Seleziona tutti
            </div>
            <div class="btn btn-danger" onclick="resetAll('console_ids\\[\\]')">
                Reset
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap">
        <div class="container">
            <div class="row">
                {{ $consoles }}
            </div>
        </div>
    </div>
    <div class="ms-4 mt-1">
        @error('console_ids')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
