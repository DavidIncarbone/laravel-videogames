@extends('layouts.master')

@section('content')
    <x-pegi-form>
        <x-slot:pegiAge><span class="fw-bold text-primary">PEGI {{ $pegi->age }}</span></x-slot>
        <x-slot:action>{{ route('admin.pegis.update', $pegi) }}</x-slot>
        <x-slot:method>@method('PUT')</x-slot>
        <x-slot:age>{{ old('age', $pegi) }}</x-slot>
        <x-slot:logo>
            @if ($pegi->logo)
                <div class="d-flex gap-3 align-items-center mt-3">
                    <div>Logo attuale:</div>
                    <div id="post-image" style="width: 50px; height:50px">
                        <img src="{{ asset('storage/' . $pegi->logo) }}" alt="PEGI {{ $pegi->age }}" class="form-image">
                    </div>
                </div>
            @endif
            <x-overlay-img>
                <x-slot:img> <img src="{{ asset('storage/' . $pegi->logo) }}" alt="PEGI {{ $pegi->age }}"
                        id="overlay-img" class="rounded shadow-sm">
                </x-slot>
            </x-overlay-img>
        </x-slot>
        <x-slot:actionToDo>Modifica</x-slot>

    </x-pegi-form>
@endsection
