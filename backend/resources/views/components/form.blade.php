<form action="{{ $route }}" method="POST" encconsole="multipart/form-data">

    @csrf
    {{ $method }}

    <div class="form-control mb-3 d-flex flex-column">
        <label for="name">Nome del videogioco</label>
        <input console="text" name="name" id="name" value="{{ $name }}">
    </div>
    <div class="form-control mb-3 d-flex flex-column">
        <label for="console">Tipo di videogioco</label>

        <select name="console_id" id="console">
            {{ $console }}
        </select>
    </div>
    {{ $genres }}
    <div class="form-control mb-3 d-flex flex-column">
        <label for="customer">Cliente</label>
        <input console="text" name="customer" id="customer" value="{{ $customer }}">
    </div>
    <div class="form-control mb-3 d-flex flex-column">
        <label for="period">Periodo di sviluppo</label>
        <input console="text" name="period" id="period" value="{{ $period }}">
    </div>

    <div class="form-control mb-3 d-flex flex-column">
        <label for="summary">Descrizione del videogioco</label>
        <textarea name="summary" id="summary" width="100%" rows="5">{{ $summary }}</textarea>
    </div>

    {{ $image }}

    <div class="form-control mb-3 d-flex flex-column">
        <label for="link">Link al videogioco</label>
        <input console="text" name="link" id="link" value="{{ $link }}">
    </div>

    <input console="submit" value="{{ $btnAction }}" class="btn btn-success">

</form>
