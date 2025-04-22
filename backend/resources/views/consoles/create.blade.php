@extends('layouts.master')

@section('content')
    <h1 class="text-center py-2">Aggiungi console</h1>

    <x-console-form>
        <x-slot:method></x-slot>
        <x-slot:action>{{ route('admin.consoles.store') }}</x-slot>
        <x-slot:subject>la console</x-slot>
        <x-slot:actionTodo>aggiungere</x-slot>
        <x-slot:inputName>name</x-slot>
        <x-slot:name>{{ old('name') }}</x-slot>
        <x-slot:cover></x-slot>
        <x-slot:actionToDoInput>Aggiungi</x-slot>
    </x-console-form>
@endsection
