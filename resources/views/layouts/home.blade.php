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

        <style>[x-cloak] { display: none; } </style>
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @livewireScripts
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            <div class="bg-white" x-data="{open:false}">

                <!-- top navigation , secondary navigation , and mobile menu -->
                @include('home._navigation')

                <main>
                    {{ $slot }}
                </main>


                @if( request()->routeIs('home') )
                    @include('home._footer')
                @endif

            </div>

        </div>


        <x-notification />


    </body>
</html>
