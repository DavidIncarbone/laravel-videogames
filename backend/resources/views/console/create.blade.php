@extends('layouts.master')

@section('content')
    <a href="{{ route('admin.type.index') }}" class="btn btn-primary my-3">
        < Torna alle type</a>

            <h1 class="text-center py-5">Aggiungi type</h1>

            <x-miniform>
                <x-slot:method></x-slot>
                <x-slot:action>{{ route('admin.type.store') }}</x-slot>
                <x-slot:subject>type</x-slot>
                <x-slot:actionTodo>aggiungere</x-slot>
                <x-slot:inputName>name</x-slot>
                <x-slot:name></x-slot>
                <x-slot:areaName>description</x-slot>
                <x-slot:description></x-slot>
                <x-slot:color></x-slot>
                <x-slot:btnAction>Aggiungi</x-slot>




            </x-miniform>
        @endsection
