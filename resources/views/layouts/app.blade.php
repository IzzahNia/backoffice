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
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
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
    </body>
</html>
