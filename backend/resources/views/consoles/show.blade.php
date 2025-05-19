@extends("layouts.master")

@section("content")
    <a href="{{ route("admin.consoles.index") }}" class="btn btn-primary my-3">
        < Torna alle console
    </a>

    <div class="section-header">
        <h2>
            Cos'è il
            <strong>{{ $console->name }}</strong>
            ?
        </h2>
    </div>
    <div class="section-content">
        <div class="row">
            <div class="col-lg-12">
                <p>{{ $console->description }}</p>
            </div>
        </div>
    </div>
@endsection
