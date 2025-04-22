<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Backoffice') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-yellow-500 to-orange-300 h-screen flex items-center justify-center text-white">

    <!-- Top-right corner buttons -->
    <div class="absolute top-4 right-4 space-x-2">
        <a href="{{ route('login') }}"
           class="px-4 py-2 text-sm bg-blue-600 text-white font-semibold rounded-full hover:bg-blue-700 transition duration-300">
            Login
        </a>
        <a href="{{ route('register') }}"
           class="px-4 py-2 text-sm bg-green-600 text-white font-semibold rounded-full hover:bg-green-700 transition duration-300">
            Register
        </a>
    </div>

    <div class="text-center space-y-6">
        <h1 class="text-4xl md:text-6xl font-bold text-blue-100">Welcome to Backoffice</h1>
        <p class="text-lg md:text-xl">Your journey begins here</p>

        <a href="{{ route('dashboard') }}"
           class="inline-block px-8 py-3 bg-white text-blue-600 font-semibold rounded-full hover:bg-gray-200 transition duration-300">
            Let's Start
        </a>
    </div>

</body>
</html>
