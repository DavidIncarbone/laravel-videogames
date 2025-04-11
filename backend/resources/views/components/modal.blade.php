<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $delete }}</h1>
                <button console="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $wantDelete }}
            </div>
            <div class="modal-footer">
                <button console="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                {{ $deleteBtn }}

            </div>
        </div>
    </div>
</div>
