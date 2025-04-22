<h1 class="text-center pb-3">{{ $actionToDo }} {{ $consoleName }}</h1>

<form id="consoleForm" action="{{ $action }}" method="POST" enctype="multipart/form-data">

    @csrf

    {{ $method }}

    <div class="mb-1">
        <small id="form-info">I campi contrassegnati con * sono obbligatori</small>
    </div>

    {{-- NAME --}}

    <div class="form-control d-flex flex-column p-3 mb-3">
        <label for="{{ $inputName }}">Inserisci {{ $subject }} da {{ $actionTodo }}*</label>
        <label for="name" id="input-info">min. 1 max. 255 caratteri</label>
        <div class="d-flex align-items-center position-relative">
            <input type="text" name="{{ $inputName }}" id="{{ $inputName }}" value="{{ $name }}"
                placeholder="Inserisci quì il nome della console" class="form-control pr-5 bg-white"
                oninput="toggleClearButton('name')">
            <span id="clear-btn-name" class="position-absolute end-0 pe-3" style="cursor: pointer; display: none;"
                onclick="clearInput('name')"><i class="fas fa-times"></i></span>
        </div>

        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    {{-- COVER --}}

    <div class="form-control d-flex flex-column p-3 mb-3">
        <label for="logo">{{ $actionToDo }} il logo</label>
        <label for="name" id="input-info">Tipi di file consentiti: jpeg,png,jpg,webp</label>
        <input type="file" name="logo" id="logo" accept=".jpeg, .jpg, .png, .webp"
            class="form-control bg-white">
        @error('logo')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        @if ($errors->any())
            <small class="text-warning">Seleziona di nuovo il file prima di inviare il modulo.</small>
        @endif
        {{ $cover }}
    </div>

    <input type="submit" value="{{ $actionToDo }}" class="btn btn-success">
    <button type="button" onclick="clearForm('consoleForm')" class="btn btn-danger">Svuota tutto</button>

</form>
