<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('', 'JMD') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-red-500 dark:bg-red-800">
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">
    <div>
        <img src="{{ asset('jmd_industries_logo_horizontal.png') }}" alt="JMD Industries Logo" class="scale-75">
    </div>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-m-rgba shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
</body>
</html>
