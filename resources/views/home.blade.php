<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Africa Electrics') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    @include('layouts.navigation')

    <!-- Page Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome to Africa Electric</h1>
        <p class="text-gray-600">Your trusted partner for electrical solutions and sustainable energy.</p>
    </div>

    {{-- @include('layouts.footer') --}}
</body>
</html>
