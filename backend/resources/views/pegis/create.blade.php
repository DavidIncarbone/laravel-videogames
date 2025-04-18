@extends('layouts.master')

@section('content')
    <h1 class="text-center py-3">Aggiungi PEGI</h1>

    <form action="{{ route('admin.pegis.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <small id="form-info">I campi contrassegnati con * sono obbligatori</small>
        </div>

        <div class="form-control d-flex flex-column p-3 mb-3">
            <label for="age">Inserisci l'età minima*</label>
            <label for="name" id="input-info">min. 1 max. 100</label>
            <input type="number" name="age" id="age" step="1" style="width:190px"
                value="{{ old('age') }}" placeholder="Inserisci quì l'età minima">
            @error('age')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-control d-flex flex-column  p-3 mb-3">
            <label for="logo">Inserisci il logo</label>
            <label for="name" id="input-info">Tipi di file consentiti: jpeg,png,jpg,webp</label>
            <input type="file" name="logo" id="logo" accept=".jpeg, .jpg, .png, .webp">
            @error('logo')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            @if ($errors->any())
                <small class="text-warning">Seleziona di nuovo il file prima di inviare il modulo.</small>
            @endif
        </div>

        <input type="submit" value="Aggiungi" class="btn btn-success">
        <button type="button" onclick="clearForm()" class="btn btn-danger">Svuota tutto</button>

    </form>
@endsection

<script>
    function clearForm() {
        const form = document.querySelector('form');
        form.querySelectorAll('input').forEach(field => {
            if (field.name === '_method' || field.name === '_token') return;
            else if (field.type !== "submit") {
                field.value = '';
            }
        });
    }
</script>
