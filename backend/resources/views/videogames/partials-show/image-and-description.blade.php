<div class="col-12 col-lg-6">
    <div class="w-100 mb-3" style="height: 50vh">
        <img src="{{ asset('storage/' . $videogame->cover) }}" alt="{{ Str::limit($videogame->name, 20) . '-cover' }}"
            class="rounded shadow-sm current-cover" style="cursor: zoom-in" />
    </div>
    <h5><strong>Descrizione:</strong></h5>
    <p>{{ $videogame->description }}</p>
</div>
