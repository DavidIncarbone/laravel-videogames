<form id="consoleForm" action="{{ $action }}" method="POST" enctype="multipart/form-data">

    @csrf

    {{ $method }}

    <div class="mb-1">
        <small id="form-info">I campi contrassegnati con * sono obbligatori</small>
    </div>

    <div class="form-control d-flex flex-column p-3 mb-3">
        <label for="{{ $inputName }}">Inserisci {{ $subject }} da {{ $actionTodo }}*</label>
        <label for="name" id="input-info">min. 1 max. 255 caratteri</label>
        <input type="text" name="{{ $inputName }}" id="{{ $inputName }}" value="{{ $name }}"
            placeholder="Inserisci quì il nome della console">

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    <div class="form-control d-flex flex-column p-3 mb-3">
        <label for="logo">{{ $actionToDoInput }} il logo</label>
        <label for="name" id="input-info">Tipi di file consentiti: jpeg,png,jpg,webp</label>
        <input type="file" name="logo" id="logo" accept=".jpeg, .jpg, .png, .webp">

        @error('logo')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        @if ($errors->any())
            <small class="text-warning">Seleziona di nuovo il file prima di inviare il modulo.</small>
        @endif
        {{ $oldImage }}
    </div>

    <input type="submit" value="{{ $actionToDoInput }}" class="btn btn-success">
    <button type="button" onclick="clearConsoleForm()" class="btn btn-danger">Svuota tutto</button>

</form>
