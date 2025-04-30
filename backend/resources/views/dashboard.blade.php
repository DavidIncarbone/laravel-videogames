@php

@endphp


@extends('layouts.master')

@section('content')
    <!-- Contenuto principale -->
    <div class="flex-grow-1 p-4">
        <div class="header d-flex justify-content-between align-items-center mb-4">
            <h1>Benvenuto nella tua Dashboard</h1>

        </div>

        <div id="dashboard-cards" class="row">
            <!-- Card per statistiche portfolio -->

            @foreach ($itemsCount as $itemCount)
                <div class="col-lg-4">
                    <div class="card">
                        <a href="{{ route($itemCount['url']) }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $itemCount['name'] }}</h5>
                                <p class="card-text"><strong>{{ $itemCount['count'] }}</strong></p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
