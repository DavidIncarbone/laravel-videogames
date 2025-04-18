<form id="videogameForm" action="{{ $route }}" method="POST" enctype="multipart/form-data" class="mb-3">

    @csrf
    {{ $method }}

    <div class="mb-1">
        <small id="form-info">I campi contrassegnati con * sono obbligatori</small>
    </div>

    <div class="form-control mb-3 d-flex flex-column p-3">
        <label for="name">Nome del videogioco*</label>
        <label for="name" id="input-info">min. 1 max. 255 caratteri</label>
        <input type="text" name="name" id="name" value="{{ $name }}"
            placeholder="Inserisci quì il nome del videogioco">
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{ $console }}
    {{ $genres }}

    <div class="form-control mb-3 d-flex flex-column p-3">
        <label for="publisher">Casa produttrice*</label>
        <label for="publisher" id="input-info">min. 1 max. 255 caratteri</label>

        <div class="d-flex flex-column">
            <input type="text" name="publisher" id="publisher" value="{{ $publisher }}"
                placeholder="Inserisci quì la casa produttrice">
            <div>
                @error('publisher')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-control mb-3 d-flex flex-column flex-lg-row gap-5 gap-lg-3 p-3">
        <div class="d-flex justify-content-between me-3 " style="height:40px">
            <div class="d-flex flex-column">
                <label for="year_of_publication" class="me-3">Anno di pubblicazione*</label>
                <label for="year_of_publication" id="input-info">1970 - Anno attuale</label>
            </div>
            <div class="d-flex flex-column ">
                <div>
                    <input type="number" id="year_of_publication" name="year_of_publication" step="1"
                        class="me-1" value="{{ old('year_of_publication', $year_of_publication) }}"
                        placeholder="Inserisci anno">
                    <div>
                        @error('year_of_publication')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column flex-lg-row gap-3">
            <div class="d-flex justify-content-between me-3 " style="height:40px">
                <div class="d-flex flex-column">
                    <label for="price" class="me-3">Prezzo (€)*</label>
                    <label for="price" id="input-info">min. 0.01€</label>
                </div>
                <div class="d-flex flex-column">
                    <div>
                        <input type="number" id="price" name="price" step="0.01"
                            value="{{ old('price', $price) }}" placeholder="Inserisci prezzo">
                        <div>
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-0 gap-lg-3">
                <label for="pegi">Pegi*</label>
                <div id="pegi" class="d-flex flex-column" style="height:40px">
                    <div id="pegi-select">
                        <select name="pegi_id" id="pegi">
                            <option value="" default>Seleziona PEGI</option>
                            {{ $pegi }}
                        </select>
                        <div class="d-flex justify-content-end ">
                            @error('pegi_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-control mb-3 d-flex flex-column p-3">
        <label for="summary">Descrizione*</label>
        <label for="name" id="input-info">min. 10 max. 500 characters</label>
        <textarea name="description" id="summary" width="100%" placeholder="Inserisci quì la descrizione del videogioco">{{ $description }}</textarea>
        <div>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    {{ $cover }}

    <div>
        <input type="submit" value="{{ $btnAction }}" class="btn btn-success">
        <button type="button" onclick="clearVideogameForm()" class="btn btn-danger">Svuota tutto</button>
    </div>

</form>
