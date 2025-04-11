@extends('layouts.master');

@section('content')
    <x-form>


        <x-slot:route>{{ route('admin.videogames.store') }}</x-slot>
        <x-slot:method></x-slot>
        <x-slot:name></x-slot>
        <x-slot:type>
            @foreach ($console as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </x-slot>
        <x-slot:genres>
            <div class="form-control mb-3 d-flex flex-wrap">
                @foreach ($genres as $technology)
                    <div class="tag me-2">
                        <input type="checkbox" name="genres[]" value="{{ $technology->id }}"
                            id="technology-{{ $technology->id }}">
                        <label for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                    </div>
                @endforeach
            </div>
        </x-slot>
        <x-slot:customer></x-slot>
        <x-slot:period></x-slot>
        <x-slot:summary></x-slot>
        <x-slot:image>

            <div class="form-control mb-3 d-flex flex-column">
                <label for="image">Immagine del videogioco</label>
                <input type="file" id="image" name="image">
            </div>
        </x-slot>
        <x-slot:link></x-slot>
        <x-slot:btnAction>Aggiungi</x-slot>

    </x-form>
@endsection
