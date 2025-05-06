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
                <div class="mt-3">Screenshot attuale:</div>
                <div class="d-flex flex-wrap gap-3 align-items-center mt-3">
                    <div id="post-image" style="width: 100px; height:100px">
                        <img id="logo" src="{{ asset('storage/' . $screenshot->url) }}"
                            alt="{{ $screenshot->videogame->name }}" class="form-image">
                    </div>
                </div>
            @endif
            <x-overlay-img>
                <x-slot:img> <img src="{{ asset('storage/' . $screenshot->url) }}"
                        alt="{{ $screenshot->videogame->name }}" id="overlay-img" class="rounded shadow-sm">
                </x-slot>
            </x-overlay-img>
        </x-slot>

    </x-screenshot-form>
@endsection
