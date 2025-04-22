@extends('layouts.master')

@section('content')
    <x-console-form>
        <x-slot:consoleName><span class="text-primary">{{ $console->name }}</span></x-slot>
        <x-slot:method>@method('PUT')</x-slot>
        <x-slot:action>{{ route('admin.consoles.update', $console) }}</x-slot>

        <x-slot:subject>la console</x-slot>
        <x-slot:actionTodo>modificare</x-slot>

        <x-slot:inputName>name</x-slot>
        <x-slot:name>{{ old('name', $console->name) }}</x-slot>
        <x-slot:actionToDo>Modifica</x-slot>

        <x-slot:cover>
            @if ($console->logo)
                <div class="d-flex gap-3 align-items-center">
                    <div>Logo attuale:</div>
                    <div id="post-image" style="width: 100px; height:50px">
                        <img id="logo" src="{{ asset('storage/' . $console->logo) }}" alt="{{ $console->name }}">
                    </div>
                </div>
            @endif
        </x-slot>

    </x-console-form>
@endsection
