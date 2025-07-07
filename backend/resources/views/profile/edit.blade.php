@extends('layouts.master')
@section('content')
    <div class="container">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profilo') }}
        </h2>
        <div class="card p-4 mb-4 bg-white shadow rounded-lg">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="card p-4 mb-4 bg-white shadow rounded-lg">
            @include('profile.partials.update-password-form')
        </div>

        <div class="card p-4 mb-4 bg-white shadow rounded-lg">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
@endsection
