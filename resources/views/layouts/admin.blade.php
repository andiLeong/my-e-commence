<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles

    <style>
        [x-cloak] { display: none !important; }
    </style>
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('head')
    @livewireScripts
</head>


<body class="font-sans antialiased">



<div class="h-screen flex overflow-hidden bg-gray-100" x-data="{ side_bar_menu_show : false}">

    {{-- sidebar layout included --}}
    @include('layouts.admin.sidebar')

    <div class="flex flex-col w-0 flex-1 overflow-hidden">
        <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
            <button @click="side_bar_menu_show = true" type="button" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                <span class="sr-only">Open sidebar222</span>
                <x-svg.menu class="h-6 w-6" />
            </button>
        </div>
        <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none">
              {{ $slot }}
        </main>
    </div>
</div>

<x-notification />
<script src="https://unpkg.com/filepond@^4/dist/filepond.js" ></script>
</body>
</html>
