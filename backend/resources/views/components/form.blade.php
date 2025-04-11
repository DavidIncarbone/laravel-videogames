<form action="{{ $route }}" method="POST" enctype="multipart/form-data">

    @csrf
    {{ $method }}

    <div class="form-control mb-3 d-flex flex-column">
        <label for="name">Nome del videogioco</label>
        <input type="text" name="name" id="name" value="{{ $name }}">
    </div>
    <div class="form-control mb-3 d-flex flex-column">
        <label for="type">Tipo di videogioco</label>

        <select name="type_id" id="type">
            {{ $type }}
        </select>
    </div>
    {{ $genres }}
    <div class="form-control mb-3 d-flex flex-column">
        <label for="customer">Cliente</label>
        <input type="text" name="customer" id="customer" value="{{ $customer }}">
    </div>
    <div class="form-control mb-3 d-flex flex-column">
        <label for="period">Periodo di sviluppo</label>
        <input type="text" name="period" id="period" value="{{ $period }}">
    </div>

    <div class="form-control mb-3 d-flex flex-column">
        <label for="summary">Descrizione del videogioco</label>
        <textarea name="summary" id="summary" width="100%" rows="5">{{ $summary }}</textarea>
    </div>

    {{ $image }}

    <div class="form-control mb-3 d-flex flex-column">
        <label for="link">Link al videogioco</label>
        <input type="text" name="link" id="link" value="{{ $link }}">
    </div>

    <input type="submit" value="{{ $btnAction }}" class="btn btn-success">

</form>
