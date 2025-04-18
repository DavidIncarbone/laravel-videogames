@extends('layouts.master')

@section('content')
    <h1 class="text-center py-3">Aggiungi genere</h1>

    <form action="{{ route('admin.genres.store') }}" method="POST">

        @csrf
        <div class="">
            <small id="form-info">I campi contrassegnati con * sono obbligatori</small>
        </div>

        <div class="form-control d-flex flex-column p-3 mb-3">
            <label for="name">Inserisci il nome del genere*</label>
            <label for="name" id="input-info">min. 1 max. 255 caratteri</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                placeholder="Inserisci qui il nome del genere" class="form-control bg-white">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror

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
