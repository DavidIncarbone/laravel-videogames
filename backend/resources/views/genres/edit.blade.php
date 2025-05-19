@extends('layouts.master')

@section('content')
    <x-genres-form>
        <x-slot:genreName>
            <span class="fw-bold text-primary">{{ $genre->name }}</span>
        </x-slot>
        <x-slot:action>
            {{ route('admin.genres.update', $genre) }}
        </x-slot>
        <x-slot:method>@method('PUT')</x-slot>

        <x-slot:name>
            {{ old('name', $genre) }}
        </x-slot>

        <x-slot:actionToDo>Modifica</x-slot>
    </x-genres-form>
@endsection
