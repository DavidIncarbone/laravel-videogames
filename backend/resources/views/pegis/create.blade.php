@extends("layouts.master")

@section("content")
    <x-pegi-form>
        <x-slot:pegiAge>PEGI</x-slot>
        <x-slot:action>
            {{ route("admin.pegis.store") }}
        </x-slot>
        <x-slot:method></x-slot>
        <x-slot:age>{{ old("age") }}</x-slot>
        <x-slot:logo></x-slot>
        <x-slot:actionToDo>Aggiungi</x-slot>
        <x-slot:overlays>
            <x-new-cover-overlay>
                <x-slot:overlayTitle>Nuovo logo</x-slot>
                <x-slot:img>
                    <img
                        src=""
                        alt=""
                        id="new-cover-overlay-img"
                        class="rounded shadow-sm w-75 w-75"
                    />
                </x-slot>
                <x-slot:index></x-slot>
            </x-new-cover-overlay>
        </x-slot>
    </x-pegi-form>
@endsection
