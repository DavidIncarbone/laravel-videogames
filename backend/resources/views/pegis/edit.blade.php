@extends('layouts.master')

@section('content')
    <x-pegi-form>
        <x-slot:action>{{ route('admin.pegis.update', $pegi) }}</x-slot>
        <x-slot:method>@method('PUT')</x-slot>
        <x-slot:age>{{ old('age', $pegi) }}</x-slot>
        <x-slot:cover></x-slot>
        <x-slot:actionToDo>Modifica</x-slot>
    </x-pegi-form>
@endsection
