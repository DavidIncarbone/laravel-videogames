@extends("layouts.master")

@section("content")
    <x-console-form>
        <x-slot:consoleName>Console</x-slot>
        <x-slot:method></x-slot>
        <x-slot:action>
            {{ route("admin.consoles.store") }}
        </x-slot>
        <x-slot:subject>la console</x-slot>
        <x-slot:actionTodo>aggiungere</x-slot>
        <x-slot:inputName>name</x-slot>
        <x-slot:name>
            {{ old("name") }}
        </x-slot>
        <x-slot:cover></x-slot>
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
    </x-console-form>
@endsection
