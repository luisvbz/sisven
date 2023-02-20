@props(['active', 'as' => 'Link'])

@php
$classes = ($active ?? false)
            ? 'flex flex-row items-center h-12 px-3 text-white bg-primary-500 rounded-none border-l-4 border-alternative-500'
            : 'flex flex-row items-center h-12 px-3 text-gray-600 hover:text-gray-600 hover:bg-gray-200 rounded-none transition duration-100 ease-out hover:ease-in';
@endphp

<{{ $as }} {{ $attributes->class($classes) }}>
    {{ $slot }}
</{{ $as }}>
