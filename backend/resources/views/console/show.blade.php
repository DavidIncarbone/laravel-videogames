@extends('layouts.master')

@section('content')
    <a href="{{ route('admin.type.index') }}" class="btn btn-primary my-3">
        < Torna alle type</a>

            <div class="section-header">
                <h2>Cos'è il <strong>{{ $type->name }}</strong>?</h2>
            </div>
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12">
                        <p>{{ $type->description }}</p>
                    </div>
                </div>
            </div>
        @endsection
