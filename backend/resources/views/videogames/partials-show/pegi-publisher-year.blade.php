<div class="d-flex align-items-center gap-3 mb-4 flex-wrap">
    <div style="width: 50px; height: 50px">
        <img src="{{ asset('storage/' . $videogame->pegi->logo) }}" alt="{{ 'PEGI ' . $videogame->pegi->age }}"
            class="img-fluid" />
    </div>
    <div>
        <div>
            <strong>Casa produttrice:</strong>
            {{ $videogame->publisher }}
        </div>
        <div>
            <strong>Anno di uscita:</strong>
            {{ $videogame->year_of_publication }}
        </div>
    </div>
</div>
