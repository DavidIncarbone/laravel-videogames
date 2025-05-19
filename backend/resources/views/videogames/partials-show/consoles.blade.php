<div class="mb-3">
    <p><strong>Disponibile per:</strong></p>
    <ul class="list-unstyled d-flex flex-wrap gap-5">
        @foreach ($videogame->consoles as $console)
            <li class="d-flex align-items-center" style="width: 75px; height: 75px">
                <img src="{{ asset('storage/' . $console->logo) }}" alt="{{ $console->name }}" class="img-fluid" />
            </li>
        @endforeach
    </ul>
</div>
