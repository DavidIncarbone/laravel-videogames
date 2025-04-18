@extends('layouts.master')

@section('content')
    <h1 class="text-center py-5">Modifica Console</h1>
    <x-miniform>
        <x-slot:method>@method('PUT')</x-slot>
        <x-slot:action>{{ route('admin.consoles.update', $console) }}</x-slot>
        <x-slot:subject>la console</x-slot>
        <x-slot:actionTodo>modificare</x-slot>
        <x-slot:inputName>name</x-slot>
        <x-slot:name>{{ old('name', $console->name) }}</x-slot>
        <x-slot:actionToDoInput>Modifica</x-slot>
        <x-slot:oldImage>
            @if ($console->logo)
                <div class="d-flex gap-3 align-items-center">
                    <div>Logo attuale:</div>
                    <div id="post-image" style="width: 100px; height:50px">
                        <img id="logo" src="{{ asset('storage/' . $console->logo) }}" alt="{{ $console->name }}">
                    </div>
                </div>
            @endif
        </x-slot>
        <x-slot:actionToDoInput>Modifica</x-slot>
    </x-miniform>
@endsection
