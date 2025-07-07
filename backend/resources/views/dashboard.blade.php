@php

@endphp


@extends('layouts.master')

@section('content')
    <!-- Contenuto principale -->
    <div id="dashboard-cards" class="flex-grow-1 p-4">
        <div class="header d-flex justify-content-between align-items-center mb-4">
            <h1>Benvenuto nella tua Dashboard</h1>

        </div>

        <div class="card m-auto mb-3">
            <a href="http://localhost:5174/" target="_blank" rel="noopener noreferrer">
                <div class="card-body rounded">
                    <h5 class="card-title text-center">Vai alla WebApp <i class="bi bi-box-arrow-up-right me-2"></i> </h5>
                </div>
            </a>
        </div>

        <hr>


        <h2 class="mb-3">Le mie entità</h2>
        <div class="row">
            <!-- Card per statistiche portfolio -->

            <!-- I dati arrivano dal DasboardController -->

            @foreach ($itemsCount as $itemCount)
                <div class="col-lg-4">
                    <div class="card">
                        <a href="{{ route($itemCount['url']) }}">
                            <div class="card-body rounded">
                                <h5 class="card-title">{{ $itemCount['name'] }}</h5>
                                <p class="card-text"><strong>{{ $itemCount['count'] }}</strong></p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endsection
