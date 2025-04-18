@extends('layouts.master')

@section('content')
    <h1 class="text-center py-3">Modifica genere</h1>

    <form action="{{ route('admin.genres.update', $genre) }}" method="POST">

        @csrf
        @method('PUT')
        <div class="">
            <small id="form-info">I campi contrassegnati con * sono obbligatori</small>
        </div>

        <div class="form-control d-flex flex-column p-3 mb-3">
            <label for="name">Inserisci il nome del genere*</label>
            <label for="name" id="input-info">min. 1 max. 255 caratteri</label>
            <input type="text" name="name" id="name" value="{{ old('name', $genre) }}"
                placeholder="Inserisci qui il nome del genere">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>

        <input type="submit" value="Modifica" class="btn btn-success">
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
