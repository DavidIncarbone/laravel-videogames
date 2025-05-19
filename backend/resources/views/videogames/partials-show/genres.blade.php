<div class="mb-3">
    <p><strong>Genere:</strong></p>
    <ul class="list-unstyled d-flex flex-wrap gap-1">
        @foreach ($videogame->genres as $genre)
            <li>{{ $genre->name }}</li>
            @if (!$loop->last)
                <span class="mx-1">-</span>
            @endif
        @endforeach
    </ul>
</div>
