<h2 class="pb-3">{{ $actionToDo }} {{ $videogameName }}</h2>

<form id="videogameForm" action="{{ $route }}" method="POST" enctype="multipart/form-data" class="mb-3">

    @csrf
    {{ $method }}

    <div class="mb-1">
        <small id="form-info">I campi contrassegnati con * sono obbligatori</small>
    </div>

    {{-- NAME --}}

    <div class="form-control mb-3 d-flex flex-column p-3">
        <label for="name">Nome del videogioco*</label>
        <label for="name" id="input-info">min. 2 max. 50 caratteri</label>
        <div class="d-flex align-items-center position-relative">
            <span class="position-absolute ps-2"><i class="fa-solid fa-gamepad"></i></span>
            <input type="text" name="name" id="name" value="{{ $name }}"
                placeholder="Inserisci quì il nome del videogioco" class="form-control pr-5 bg-white ps-5 pe-5"
                oninput="toggleClearButton('name')">
            <span id="clear-btn-name" class="position-absolute end-0 pe-3" style="cursor: pointer; display: none;"
                onclick="clearInput('name')"><i class="fas fa-times"></i></span>
        </div>
        @error('name')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    {{-- CONSOLES --}}

    <div class="form-control mb-3 p-3">
        <div class="d-flex gap-3 justify-content-between">
            <label class="mb-3" for="allConsoles">Console*</label>
            <div class="form-check d-flex align-items-center gap-1 mb-3">
                <div class="btn btn-secondary" onclick="selectAll('console_ids\\[\\]')">
                    Seleziona tutti</div>
                <div class="btn btn-danger" onclick="resetAll('console_ids\\[\\]')">
                    Reset</div>
            </div>
        </div>

        <div class="d-flex flex-wrap">
            <div class="container">
                <div class="row">
                    {{ $consoles }}
                </div>
            </div>
        </div>
        <div class="ms-4 mt-1">
            @error('console_ids')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    {{-- GENRES --}}

    <div class="form-control mb-3 p-3">
        <div class="d-flex gap-3 justify-content-between mb-3">
            <label class="mb-3" for="allGenres">Generi*</label>
            <div class="form-check d-flex align-items-center gap-1">
                <div class="btn btn-secondary" onclick="selectAll('genre_ids\\[\\]')">
                    Seleziona tutti</div>
                <div class="btn btn-danger" onclick="resetAll('genre_ids\\[\\]')">
                    Reset</div>
            </div>
        </div>
        <div class="d-flex flex-wrap">
            <div class="container">
                <div class="row">
                    {{ $genres }}
                </div>
            </div>

        </div>
        <div class="ms-4 mt-1">
            @error('genre_ids')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    {{-- PUBLISHER --}}

    <div class="form-control mb-3 d-flex flex-column p-3">
        <label for="publisher">Casa produttrice*</label>
        <label for="publisher" id="input-info">min. 2 max. 50 caratteri</label>
        <div class="d-flex align-items-center position-relative">
            <span class="position-absolute ps-2"> <i class="fa-solid fa-house-laptop"></i></span>
            <input type="text" name="publisher" id="publisher" value="{{ $publisher }}"
                placeholder="Inserisci quì la casa produttrice" class="form-control pr-5 bg-white ps-5 pe-5"
                oninput="toggleClearButton('publisher')">
            <span id="clear-btn-publisher" class="position-absolute end-0 pe-3" style="cursor: pointer; display: none;"
                onclick="clearInput('publisher')"><i class="fas fa-times"></i></span>
        </div>
        <div>
            @error('publisher')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="form-control mb-3 d-flex flex-column flex-lg-row gap-4 gap-lg-3 p-3 pb-5 pb-lg-3">

        {{-- YEAR OF PUBLICATION --}}

        <div class="d-flex justify-content-between me-3">
            <div class="d-flex flex-column w-50">
                <label for="year_of_publication" class="me-3">Anno di pubblicazione*</label>
                <label for="year_of_publication" id="input-info">1970 - Anno attuale</label>
            </div>
            <div class="d-flex flex-column position-relative">
                <div>
                    <span class="position-absolute pt-2 ps-2"><i class="fa-solid fa-calendar-days"></i></span>
                    <input type="number" id="year_of_publication" name="year_of_publication" step="1"
                        class="me-1 form-control bg-white ps-5"
                        value="{{ old('year_of_publication', $year_of_publication) }}" placeholder="Inserisci anno">
                    <div>
                        @error('year_of_publication')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- PRICE --}}

        <div class="d-flex flex-column flex-lg-row gap-3">
            <div class="d-flex justify-content-between me-3 ">
                <div class="d-flex flex-column w-50">
                    <label for="price" class="me-3">Prezzo (€)*</label>
                    <label for="price" id="input-info">min. 0.01€</label>
                </div>
                <div class="d-flex flex-column">
                    <div>
                        <span class="position-absolute ps-2 pt-2"><i
                                class="fa-solid fa-money-check-dollar"></i></span>
                        <input type="number" id="price" name="price" step="0.01"
                            value="{{ old('price', $price) }}" placeholder="Inserisci prezzo"
                            class="form-control bg-white ps-5">

                        <div>
                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- PEGIS --}}

            <div class="d-flex gap-0 gap-lg-3">
                <div>
                    <label for="pegi">Pegi*</label>
                </div>
                <div id="pegi" class="d-flex flex-column">
                    <div id="pegi-select">
                        <select name="pegi_id" id="pegi_id" class="form-select bg-white">

                            {{ $pegis }}
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

    {{-- DESCRIPTION --}}

    <div class="form-control mb-3 d-flex flex-column p-3">
        <label for="description">Descrizione*</label>
        <label for="name" id="input-info">min. 10 max. 255 characters</label>
        <div class="d-flex align-items-center position-relative">
            <textarea name="description" id="description" width="100%"
                placeholder="Inserisci quì la descrizione del videogioco" oninput="toggleClearButton('description')"
                class="form-control pr-5 pe-5 bg-white">{{ $description }}</textarea>
            <span id="clear-btn-description" class="position-absolute end-0 pe-3"
                style="cursor: pointer; display: none;" onclick="clearInput('description')"><i
                    class="fas fa-times"></i></span>
        </div>
        <div>
            @error('description')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    {{-- COVER --}}

    <div class="form-control mb-3 d-flex flex-column p-3">
        <label for="cover">Cover*</label>
        <label for="name" id="input-info">Tipi di file consentiti: jpeg,png,jpg,webp | Max. 2 MB</label>
        <input type="file" id="cover" name="cover" accept=".jpeg, .jpg, .png, .webp"
            class="form-control bg-white mb-3">
        <div id="new-cover" class="d-none">Nuova Cover:</div>
        <div class="preview-container" id="preview-cover-container">

        </div>
        @error('cover')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        @if ($errors->any())
            <small class="text-warning">Seleziona di nuovo il file prima di inviare il modulo.</small>
        @endif

        {{ $cover }}
    </div>


    <div class="form-control mb-3 d-flex flex-column p-3">
        <div class="d-flex justify-content-between">
            <label for="screenshots">{{ $actionToDo }} Screenshots</label> <button type="button"
                class="btn btn-danger" id="clear-screenshots" onclick="clearScreenshots()">Reset</button>
        </div>

        <label for="name" id="input-info">Tipi di file consentiti: jpeg,png,jpg,webp | Dimensione Max. per
            immagine: 2 MB | Max. 4 immagini</label>
        <input type="file" id="screenshots" name="screenshots[]" accept=".jpeg, .jpg, .png, .webp"
            class="form-control bg-white mb-3" multiple>
        <div id="new-screenshots" class="d-none">Nuovi Screenshots:</div>
        <div class="preview-container" id="previewContainer">

        </div>

        @error('screenshots')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        @error('screenshots.*')
            <small class="text-danger">{{ $message }}</small>
        @enderror
        @if ($errors->any())
            <small class="text-warning">Seleziona di nuovo i files prima di inviare il modulo.</small>
        @endif
        {{ $screenshots }}
    </div>

    {{ $overlays }}

    <div>
        <input type="submit" id="submit-videogame" value="{{ $actionToDo }}" class="btn btn-success">
        <button type="button" onclick="clearVideogameForm()" class="btn btn-danger">Svuota tutto</button>
    </div>



</form>
