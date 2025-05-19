@extends("layouts.master")

@section("content")
    <a
        href="{{ route("admin.screenshots.index") }}"
        class="btn btn-dark text-decoration-none mb-3"
    >
        Torna agli screenshot
    </a>

    <h1>Nessun videogioco selezionato a cui aggiungere screenshot.</h1>
@endsection
