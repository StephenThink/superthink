@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-yellow inline-flex items-center px-1 pt-1 border-b-2 border-white text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition'
            : 'text-light inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-500 hover:text-yellow hover:border-gray-300 focus:outline-none focus:text-yellow transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
