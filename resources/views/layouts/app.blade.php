<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Quicksand Font -->
        <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Global Quicksand Font Styles -->
        <style>
        * {
            font-family: "Quicksand", sans-serif !important;
            font-optical-sizing: auto;
            font-style: normal;
        }
        
        body {
            font-family: "Quicksand", sans-serif !important;
            font-weight: 400;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: "Quicksand", sans-serif !important;
            font-weight: 600;
        }
        
        .quicksand-light { font-weight: 300; }
        .quicksand-regular { font-weight: 400; }
        .quicksand-medium { font-weight: 500; }
        .quicksand-semibold { font-weight: 600; }
        .quicksand-bold { font-weight: 700; }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
