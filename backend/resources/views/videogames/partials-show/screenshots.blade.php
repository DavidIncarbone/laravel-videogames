@if ($videogame->screenshots->isNotEmpty())
    <h3>Screenshot allegati:</h3>

    <div class="d-flex flex-wrap gap-3">
        @foreach ($videogame->screenshots as $screenshot)
            <div>
                <img src="{{ asset('storage/' . $screenshot->url) }}" alt="{{ $videogame->name }}"
                    class="current-screenshot" style="cursor: zoom-in" />
            </div>
        @endforeach
    </div>
@endif
