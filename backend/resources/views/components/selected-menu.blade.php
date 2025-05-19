<div
    class="selected-menu p-3 selected-menu d-none align-items-center justify-content-between gap-1 gap-lg-3"
>
    <div>
        <span id="selected-count" class="fw-bold"></span>
        <span id="selected-info"></span>
    </div>
    <button
        id="cancel-all"
        class="btn btn-secondary d-flex justify-content-center align-items-center"
    >
        <i class="fa-sharp fa-solid fa-xmark"></i>
        <span class="d-none d-lg-block">Annulla selezione</span>
    </button>
    <button
        id="deleteAll"
        class="btn btn-danger d-flex justify-content-center align-items-center"
        data-bs-toggle="modal"
        data-bs-target="#deleteSelectedModal"
    >
        <i class="bi bi-trash"></i>
        <span class="d-none d-lg-inline">Elimina selezione</span>
    </button>
</div>
