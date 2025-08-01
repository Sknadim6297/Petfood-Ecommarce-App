<!-- PetNet Logo Component -->
@props([
    'size' => 'md',
    'variant' => 'default',
    'clickable' => true,
    'route' => 'admin.dashboard'
])

@php
$sizeClasses = [
    'xs' => 'w-6 h-6',
    'sm' => 'w-8 h-8', 
    'md' => 'w-12 h-12',
    'lg' => 'w-16 h-16',
    'xl' => 'w-20 h-20'
];

$variantClasses = [
    'default' => 'bg-white p-2 rounded-lg shadow-md',
    'circle' => 'bg-white p-3 rounded-full shadow-md',
    'minimal' => 'p-1',
    'header' => 'bg-orange-50 p-1 rounded-md'
];

$classes = ($sizeClasses[$size] ?? $sizeClasses['md']) . ' ' . ($variantClasses[$variant] ?? $variantClasses['default']);
@endphp

@if($clickable && $route)
    <a href="{{ route($route) }}" 
       class="inline-flex items-center justify-center transition-all duration-300 hover:scale-105 hover:shadow-lg {{ $classes }}"
       title="PetNet Admin Dashboard">
        <img src="{{ asset('assets/img/logo/petnet_logo.png') }}" 
             alt="PetNet Logo" 
             class="w-full h-full object-contain">
    </a>
@else
    <div class="inline-flex items-center justify-center {{ $classes }}">
        <img src="{{ asset('assets/img/logo/petnet_logo.png') }}" 
             alt="PetNet Logo" 
             class="w-full h-full object-contain">
    </div>
@endif
