<div class="d-flex gap-3">
    <form method="GET" action="{{ $route }}">
        <div class="input-group">
            <div class="form-outline position-relative">
                <input type="text" id='searchInput' name="search" class="form-control pr-5 bg-white pe-4"
                    value='{{ request('search') }}' placeholder='Cerca per {{ $subject }}'
                    oninput="toggleClearButton('searchInput')" />
                <span id="clear-btn-searchInput" class="position-absolute mt-2 top-0 end-0 pe-2"
                    style="cursor: pointer; display:none;" onclick="clearInput('searchInput')"><i
                        class="fas fa-times"></i></span>
            </div>
            <button type="submit" id='searchBtn' class="btn btn-primary" disabled>
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>


    <button id="showAll" class="btn btn-primary"{{ $disabled }}> <a href="{{ $route }}"
            class="text-decoration-none text-white">
            Mostra tutti</a>
    </button>

</div>
