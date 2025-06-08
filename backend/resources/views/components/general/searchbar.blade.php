<form method="GET" action="{{ $route }}" class="input-group d-flex flex-column flex-lg-row gap-2 mb-3">
    <div class="d-flex gap-3">
        <div class="form-outline position-relative">
            <input type="text" id="searchInput" name="search" class="form-control pr-5 bg-white pe-4"
                value="{{ request('search') }}" placeholder="Cerca per {{ $subject }}"
                oninput="toggleClearButton('searchInput')" />
            <span id="clear-btn-searchInput" class="position-absolute mt-2 top-0 end-0 pe-2"
                style="cursor: pointer; display: none" onclick="clearInput('searchInput')">
                <i class="fas fa-times"></i>
            </span>
        </div>
        <div>
            {{ $publishers }}
        </div>
    </div>

    <div class="d-flex gap-3">

        <div class="d-flex gap-3">

            <label for="orderFor" class="d-flex align-self-center d-none d-lg-block">
                Ordina per:
            </label>
            <div class="d-flex align-items-start gap-3">
                <select name="orderFor" id="orderFor" class="form-select bg-white">
                    <option value="create" {{ request('orderFor') == 'create' ? 'selected' : '' }}>
                        Data creazione
                    </option>

                    <option value="edit" {{ request('orderFor') == 'edit' ? 'selected' : '' }}>
                        Data ultima modifica
                    </option>
                </select>

                <select name="orderBy" class="form-select bg-white">
                    <option value="asc" {{ request('orderBy') == 'asc' ? 'selected' : '' }}>
                        Crescente
                    </option>
                    <option value="desc" {{ request('orderBy') == 'desc' ? 'selected' : '' }}>
                        Decrescente
                    </option>
                </select>
            </div>

            <input type="hidden" name="paginate" value="{{ request('paginate') }}">

        </div>

        <div>
            <button type="submit" id="searchBtn" class="btn btn-primary rounded-3">
                Filtra
            </button>
        </div>
    </div>


</form>
