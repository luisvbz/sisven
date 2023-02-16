<x-app-layout>
    <x-slot name="header">
        {{ $hader ?? ''}}
    </x-slot>

    <x-slot name="menu">
        {{ $menu ?? ''}}
    </x-slot>

    {{ $slot }}

</x-app-layout>
