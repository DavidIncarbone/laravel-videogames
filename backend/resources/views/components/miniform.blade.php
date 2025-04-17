<form action="{{ $action }}" method="POST" enctype="multipart/form-data">

    @csrf

    {{ $method }}

    <div class="mb-3">
        <small>I campi contrassegnati con * sono obbligatori</small>
    </div>

    <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
        <label for="{{ $inputName }}">Inserisci la {{ $subject }} da {{ $actionTodo }}*</label>
        <input type="text" name="{{ $inputName }}" id="{{ $inputName }}" value="{{ $name }}"
            placeholder="Inserisci quì il nome della console">
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    <div class="form-control d-flex flex-column gap-2 mb-3">
        <label for="logo">Modifica il logo</label>
        <input type="file" name="logo" id="logo">
        @error('logo')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        @if ($errors->any())
            <small class="text-warning">Seleziona di nuovo il file prima di inviare il modulo.</small>
        @endif
    </div>

    <input type="submit" value="{{ $btnAction }}" class="btn btn-success">
</form>
