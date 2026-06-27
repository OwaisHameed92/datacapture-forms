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
    <body class="font-sans text-slate-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-50 px-4">
            <div class="mb-6">
                <a href="/" class="inline-flex items-center">
                    <img src="{{ asset('images/logo-switch.png') }}" alt="Switch&Save Business Services Ltd" class="h-11 w-auto">
                </a>
            </div>

            <div class="w-full sm:max-w-md overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="h-1.5 bg-gradient-to-r from-blue-600 via-blue-500 to-emerald-500"></div>
                <div class="px-7 py-7">
                    {{ $slot }}
                </div>
            </div>

            <p class="mt-6 text-center text-[11px] text-slate-400">
                &copy; {{ date('Y') }} Switch&amp;Save Business Services Ltd &middot; Authorised &amp; regulated by the FCA, FRN 1052230
            </p>
        </div>
    </body>
</html>
