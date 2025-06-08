<form id="{{ $id }}" class="d-flex align-items-center gap-2" action="{{ $route }}" method="GET">
    <label for="paginate">Mostra per pagina:</label>
    <select id="paginate" name="paginate" class="form-select bg-white" style="width:70px;"
        onchange="document.getElementById('{{ $id }}').submit()">
        <option value="5" {{ request('paginate') == 5 ? 'selected' : '' }}>
            5
        </option>
        <option value="10" {{ request('paginate') == 10 ? 'selected' : '' }}>
            10
        </option>
        <option value="15" {{ request('paginate') == 15 ? 'selected' : '' }}>
            15
        </option>
        <input type="hidden" name="search" value="{{ request('search') }}">
        {{ $hiddenPublisher }}
        <input type="hidden" name="orderFor" value="{{ request('orderFor') }}">
        <input type="hidden" name="orderBy" value="{{ request('orderBy') }}">

    </select>
</form>
