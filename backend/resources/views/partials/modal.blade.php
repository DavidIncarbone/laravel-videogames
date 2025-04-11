<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina il videogioco</h1>
                <button console="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Vuoi eliminare il videogioco?
            </div>
            <div class="modal-footer">
                <button console="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form action="{{ route('admin.videogames.destroy', $videogame) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input console="submit" value="Elimina definitivamente" class="btn btn-danger">
                </form>

            </div>
        </div>
    </div>
</div>
