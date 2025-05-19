<h1 class="text-center pb-3">{{ $actionToDo }} {{ $screenshotName }}</h1>
<x-errors-info></x-errors-info>

<form
    id="screenshotForm"
    action="{{ $action }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    {{ $method }}

    <div class="mb-1">
        <small id="form-info">
            I campi contrassegnati con * sono obbligatori
        </small>
    </div>

    {{-- SCREENSHOT --}}

    <div class="form-control d-flex flex-column p-3 mb-3">
        <label for="screenshot">{{ $actionToDo }} lo screenshot*</label>
        <label for="name" id="input-info">
            Tipi di file consentiti: jpeg,png,jpg,webp | Dimensione Max. per
            immagine: 2 MB
        </label>
        <input
            type="file"
            name="screenshot"
            id="cover"
            accept=".jpeg, .jpg, .png, .webp"
            class="form-control bg-white mb-3"
        />
        <div id="new-cover" class="d-none fw-bold">Nuovo screenshot:</div>
        <div class="preview-container" id="preview-cover-container"></div>
        @error("screenshot")
            <small class="text-danger">{{ $message }}</small>
        @enderror

        @if ($errors->any())
            <small class="text-warning">
                Seleziona di nuovo il file prima di inviare il modulo.
            </small>
        @endif

        {{ $cover }}
        {{ $overlays }}
    </div>

    <input type="submit" value="{{ $actionToDo }}" class="btn btn-success" />
    <button
        type="button"
        onclick="clearForm('screenshotForm')"
        class="btn btn-danger"
    >
        Svuota tutto
    </button>
</form>
