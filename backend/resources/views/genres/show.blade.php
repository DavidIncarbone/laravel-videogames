@extends('layouts.master')

@section('content')
    <a href="{{ route('admin.genres.index') }}" class="btn btn-primary my-3">
        < Torna alle generi</a>

            <div class="section-header">
                <h2>Cos'è <span class="badge" style="background-color:{{ $genre->color }}">{{ $genre->name }}</span> ?</h2>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <p>{{ $genre->description }}</p>
                    </div>
                </div>
            </div>
        @endsection
