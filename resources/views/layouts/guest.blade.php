<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .theme-primary { color: #eac14a; }
            .theme-secondary { color: black; }
            .border-theme-primary { border: 3px solid #eac14a !important; }
            .border-theme-secondary { border: 3px solid black !important; }
            .bg-theme-primary { background-color: #eac14a !important; }
            .bg-theme-secondary { background-color: #697e3e !important; }
            .bg-theme-third { background-color: #f6ff8b !important; }
            .bg-theme-four { background-color: white !important; }
            .bg-theme-five { background-color: black !important; }
        </style>
    </head>
    <body class="font-sans text-black antialiased" style="background-image: url('https://images.unsplash.com/photo-1661260101232-bd47a10035b8?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Logo removed -->

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white bg-opacity-90 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
