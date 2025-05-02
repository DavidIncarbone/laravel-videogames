@extends('layouts.master')

@section('content')
    <x-pegi-form>
        <x-slot:pegiAge>PEGI</x-slot>
        <x-slot:action>{{ route('admin.pegis.store') }}</x-slot>
        <x-slot:method></x-slot>
        <x-slot:age>{{ old('age') }}</x-slot>
        <x-slot:logo></x-slot>
        <x-slot:actionToDo>Aggiungi</x-slot>
    </x-pegi-form>
@endsection
