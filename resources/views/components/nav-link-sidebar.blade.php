@props(['active', 'as' => 'Link'])

@php
$classes = ($active ?? false)
            ? 'flex flex-row items-center h-10 px-3 text-gray-700 bg-gray-100 rounded-lg'
            : 'flex flex-row items-center h-10 px-3 text-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700';
@endphp

<{{ $as }} {{ $attributes->class($classes) }}>
    {{ $slot }}
</{{ $as }}>
