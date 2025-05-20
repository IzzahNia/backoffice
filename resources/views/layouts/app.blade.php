<!-- filepath: /Users/moafif/Development/FYP/backoffice/resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/jpeg" href="{{ asset('assets/logo.jpeg') }}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

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
    <body class="font-sans antialiased">
        <!-- Top Header Bar -->
        <div class="w-full bg-theme-third">
            <div class="max-w-7xl mx-auto flex flex-row items-center justify-center gap-2 px-4 py-3">
                <span class="text-black text-sm font-semibold">Follow us on</span>
                <a href="https://instagram.com/pasarsera" target="_blank" rel="noopener"
                   class="inline-flex items-center bg-theme-primary hover:bg-pink-700 text-black text-xs font-bold px-3 py-1 rounded transition ml-2">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5A4.25 4.25 0 0 0 20.5 16.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zm4.25 2.25a6.25 6.25 0 1 1 0 12.5 6.25 6.25 0 0 1 0-12.5zm0 1.5a4.75 4.75 0 1 0 0 9.5 4.75 4.75 0 0 0 0-9.5zm6.25 1.25a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                    </svg>
                    @pasarsera
                </a>
            </div>
        </div>
        <div class="min-h-screen bg-white">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Global Flash Messages -->
            @if (session()->has('error') || session()->has('message'))
            <div id="flash-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white rounded-lg shadow-lg max-w-md w-full p-6">
                    @if (session()->has('error'))
                        <div class="text-red-700">
                            <h3 class="text-lg font-bold mb-2">Error</h3>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    @if (session()->has('message'))
                        <div class="text-green-700">
                            <h3 class="text-lg font-bold mb-2">Success</h3>
                            <p>{{ session('message') }}</p>
                        </div>
                    @endif

                    <div class="mt-4 flex justify-end">
                        <button id="close-modal" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                            Close
                        </button>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const modal = document.getElementById('flash-modal');
                    const closeModal = document.getElementById('close-modal');

                    closeModal.addEventListener('click', function () {
                        modal.style.display = 'none';
                    });

                    // Auto-close modal after 5 seconds
                    setTimeout(() => {
                        modal.style.display = 'none';
                    }, 5000);
                });
            </script>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
    </body>
</html>
