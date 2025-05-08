@extends('layouts.master')

@section('content')
    <x-screenshot-form>
        <x-slot:screenshotName><span class="text-primary"> lo screenshot di {{ $screenshot->videogame->name }}</span></x-slot>
        <x-slot:method>@method('PUT')</x-slot>
        <x-slot:action>{{ route('admin.screenshots.update', $screenshot) }}</x-slot>
        <x-slot:inputName>name</x-slot>
        <x-slot:name>{{ old('name', $screenshot->name) }}</x-slot>
        <x-slot:actionToDo>
            Modifica</x-slot>

        <x-slot:cover>
            @if ($screenshot->url)
                <div class="mt-3 fw-bold">Screenshot attuale:</div>
                <div class="d-flex flex-wrap gap-3 align-items-center my-3">
                    <div id="post-image" class="col-6 col-lg-12 g-3" style="width:124px; height:100px; cursor:zoom-in">
                        <img src="{{ asset('storage/' . $screenshot->url) }}" alt="{{ $screenshot->videogame->name }}"
                            class="current-cover">
                    </div>
                </div>
            @endif
        </x-slot>

        {{-- OVERLAYS --}}

        <x-slot:overlays>

            <x-new-cover-overlay>
                <x-slot:overlayTitle>Nuovo screenshot</x-slot>
                <x-slot:img> <img src="" alt="" id="new-cover-overlay-img" class="rounded shadow-sm">
                </x-slot>
                <x-slot:index></x-slot>
            </x-new-cover-overlay>


            <x-current-cover-overlay>
                <x-slot:overlayTitle>Screenshot attuale</x-slot>
                <x-slot:img> <img src="" alt="" id="current-cover-overlay-img"
                        class="rounded shadow-sm w-75 w-75">
                </x-slot>
            </x-current-cover-overlay>

            <x-slot:overlays>

    </x-screenshot-form>
@endsection
