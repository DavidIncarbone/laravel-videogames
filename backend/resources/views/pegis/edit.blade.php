@extends('layouts.master')

@section('content')
    <x-pegi-form>
        <x-slot:pegiAge><span class="fw-bold text-primary">PEGI {{ $pegi->age }}</span></x-slot>
        <x-slot:action>{{ route('admin.pegis.update', $pegi) }}</x-slot>
        <x-slot:method>@method('PUT')</x-slot>
        <x-slot:age>{{ old('age', $pegi) }}</x-slot>
        <x-slot:logo>
            @if ($pegi->logo)
                <div class="d-flex flex-column gap-3 mt-3">
                    <div class="fw-bold">Logo attuale:</div>
                    <div id="post-image" class="col-6 col-lg-12 g-3" style="width:124px; height:100px">
                        <img id="logo" src="{{ asset('storage/' . $pegi->logo) }}" alt="{{ $pegi->age }}"
                            class="current-cover">
                    </div>
                </div>
            @endif

        </x-slot>

        {{-- OVERLAY --}}

        <x-slot:overlays>
            <x-new-cover-overlay>
                <x-slot:overlayTitle>Nuovo logo</x-slot>
                <x-slot:img> <img src="" alt="" id="new-cover-overlay-img"
                        class="rounded shadow-sm w-75 w-75">
                </x-slot>
                <x-slot:index></x-slot>
            </x-new-cover-overlay>

            <x-current-cover-overlay>
                <x-slot:overlayTitle>Logo attuale </x-slot>
                <x-slot:img> <img src="" alt="" id="current-cover-overlay-img"
                        class="rounded shadow-sm w-75 w-75">
                </x-slot>
                <x-slot:index></x-slot>
            </x-current-cover-overlay>

        </x-slot:overlays>
        <x-slot:actionToDo>Modifica</x-slot>


    </x-pegi-form>
@endsection
