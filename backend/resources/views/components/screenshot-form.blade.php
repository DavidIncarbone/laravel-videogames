<h1 class="text-center pb-3">{{ $actionToDo }} {{ $screenshotName }}</h1>

<form id="screenshotForm" action="{{ $action }}" method="POST" enctype="multipart/form-data">

    @csrf

    {{ $method }}

    <div class="mb-1">
        <small id="form-info">I campi contrassegnati con * sono obbligatori</small>
    </div>

    {{-- COVER --}}

    <div class="form-control d-flex flex-column p-3 mb-3">
        <label for="screenshot">{{ $actionToDo }} lo screenshot*</label>
        <label for="name" id="input-info">Tipi di file consentiti: jpeg,png,jpg,webp</label>
        <input type="file" name="screenshot" id="screenshot" accept=".jpeg, .jpg, .png, .webp"
            class="form-control bg-white">
        @error('screenshot')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        @if ($errors->any())
            <small class="text-warning">Seleziona di nuovo il file prima di inviare il modulo.</small>
        @endif
        {{ $cover }}
    </div>

    <input type="submit" value="{{ $actionToDo }}" class="btn btn-success">
    <button type="button" onclick="clearForm('screenshotForm')" class="btn btn-danger">Svuota tutto</button>

</form>
