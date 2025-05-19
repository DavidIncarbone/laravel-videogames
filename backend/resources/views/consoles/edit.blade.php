@extends('layouts.master')

@section('content')
    <x-console-form>
        <x-slot:consoleName>
            <span class="text-primary">{{ $console->name }}</span>
        </x-slot>
        <x-slot:method>@method('PUT')</x-slot>
        <x-slot:action>
            {{ route('admin.consoles.update', $console) }}
        </x-slot>

        <x-slot:subject>la console</x-slot>
        <x-slot:actionTodo>modificare</x-slot>

        <x-slot:inputName>name</x-slot>
        <x-slot:name>
            {{ old('name', $console->name) }}
        </x-slot>
        <x-slot:actionToDo>Modifica</x-slot>

        <x-slot:cover>
            @if ($console->logo)
                <div class="d-flex flex-column gap-3 mt-3">
                    <div class="fw-bold">Logo attuale:</div>
                    <div id="post-image" class="col-6 col-lg-12 g-3" style="width: 100px; height: 50px">
                        <img id="logo" src="{{ asset('storage/' . $console->logo) }}" alt="{{ $console->name }}"
                            class="current-cover" />
                    </div>
                </div>
            @endif
        </x-slot>

        {{-- OVERLAY --}}

        <x-slot:overlays>
            <x-new-cover-overlay>
                <x-slot:overlayTitle>Nuovo logo</x-slot>
                <x-slot:img>
                    <img src="" alt="" id="new-cover-overlay-img" class="rounded shadow-sm w-75 w-75" />
                </x-slot>
                <x-slot:index></x-slot>
            </x-new-cover-overlay>

            <x-current-cover-overlay>
                <x-slot:overlayTitle>Logo attuale</x-slot>
                <x-slot:img>
                    <img src="" alt="" id="current-cover-overlay-img" class="rounded shadow-sm w-75 w-75" />
                </x-slot>
                <x-slot:index></x-slot>
            </x-current-cover-overlay>
        </x-slot>
    </x-console-form>
@endsection
