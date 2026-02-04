<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - STEMS' : 'STEMS - Equipment Rental Management' }}</title>
    <link rel="icon" type="image/png" href="/images/stems-logo-dark.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased transition-colors duration-300" x-cloak>
    {{ $slot }}
    @livewireScripts
</body>
</html>
