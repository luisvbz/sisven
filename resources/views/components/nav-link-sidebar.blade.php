@props(['active', 'as' => 'Link'])

@php
$classes = ($active ?? false)
            ? 'flex flex-row items-center h-10 px-3 text-gray-700 bg-gray-100 rounded-lg'
            : 'flex flex-row items-center h-10 px-3 text-white rounded-lg hover:bg-gray-100 hover:text-gray-700 transition duration-100 ease-out hover:ease-in';
@endphp

<{{ $as }} {{ $attributes->class($classes) }}>
    {{ $slot }}
</{{ $as }}>
