<h1 class="fs-2 text-center text-lg-start">
    {{ $videogame->name }}
</h1>
<p class="text-muted text-center text-lg-start">
    Esplora i dettagli completi del videogioco.
</p>
<div
    id="icons"
    class="d-flex flex-column flex-md-row align-items-center gap-0 gap-md-2 position-absolute top-0 end-0"
>
    <a
        class="text-decoration-none text-dark"
        href="{{ route("admin.videogames.edit", $videogame) }}"
    >
        <i id="pencil" class="bi bi-pencil"></i>
    </a>
    <button
        type="button"
        class="text-decoration-none text-dark btn p-0"
        data-bs-toggle="modal"
        data-bs-target="#deleteModal"
        data-videogame-slug="{{ $videogame->slug }}"
        data-videogame-name="{{ $videogame->name }}"
    >
        <i id="trash" class="bi bi-trash"></i>
    </button>
</div>
