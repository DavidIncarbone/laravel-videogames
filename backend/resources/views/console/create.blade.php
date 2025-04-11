@extends('layouts.master')

@section('content')
    <a href="{{ route('admin.console.index') }}" class="btn btn-primary my-3">
        < Torna alle console</a>

            <h1 class="text-center py-5">Aggiungi console</h1>

            <x-miniform>
                <x-slot:method></x-slot>
                <x-slot:action>{{ route('admin.console.store') }}</x-slot>
                <x-slot:subject>console</x-slot>
                <x-slot:actionTodo>aggiungere</x-slot>
                <x-slot:inputName>name</x-slot>
                <x-slot:name></x-slot>
                <x-slot:areaName>description</x-slot>
                <x-slot:description></x-slot>
                <x-slot:color></x-slot>
                <x-slot:btnAction>Aggiungi</x-slot>




            </x-miniform>
        @endsection
