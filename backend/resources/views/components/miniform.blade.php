<form action="{{ $action }}" method="POST" enctype="multipart/form-data">

    @csrf

    {{ $method }}

    <div class="form-control d-flex flex-column gap-2 pb-3 mb-3">
        <label for="{{ $inputName }}">Inserisci la {{ $subject }} da {{ $actionTodo }}</label>
        <input type="text" name="{{ $inputName }}" id="{{ $inputName }}" value="{{ $name }}">
    </div>

    <div class="form-control d-flex flex-column gap-2 mb-3">
        <label for="logo">Modifica il logo</label>
        <input type="file" name="logo" id="logo">
    </div>

    <input type="submit" value="{{ $btnAction }}" class="btn btn-success">
</form>
