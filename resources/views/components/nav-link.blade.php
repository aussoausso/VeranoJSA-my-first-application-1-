@props(['active' => false])

@php
$classes = $active
            ? 'bg-purple-900 text-white px-3 py-2 rounded-md text-sm font-medium'
            : 'text-purple-100 hover:text-white px-3 py-2 rounded-md text-sm font-medium';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
