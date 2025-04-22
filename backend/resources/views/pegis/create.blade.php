@extends('layouts.master')

@section('content')
    <x-pegi-form>
        <x-slot:action>{{ route('admin.pegis.store') }}</x-slot>
        <x-slot:method></x-slot>
        <x-slot:age>{{ old('age') }}</x-slot>
        <x-slot:cover></x-slot>
        <x-slot:actionToDo>Aggiungi</x-slot>
    </x-pegi-form>
@endsection
