@extends("layouts.master")

@section("content")
    <x-genres-form>
        <x-slot:genreName>Genere</x-slot>
        <x-slot:action>
            {{ route("admin.genres.store") }}
        </x-slot>
        <x-slot:method></x-slot>

        <x-slot:name>
            {{ old("name") }}
        </x-slot>

        <x-slot:actionToDo>Aggiungi</x-slot>
    </x-genres-form>
@endsection
