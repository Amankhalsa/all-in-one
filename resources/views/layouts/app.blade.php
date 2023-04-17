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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        @stack('topscripts') 
        @php $path = public_path('build/assets'); 
        @endphp
                @if (file_exists($path))
                @foreach (scandir($path) as $file)
                    @if (strpos($file, '.css'))
                <link rel="stylesheet" href="{{ asset('build/assets/' . $file) }}">
                    @endif
                    @if (strpos($file, '.js'))
                        @push('scripts')
                <script src="{{ asset('build/assets/' . $file) }}"></script>
                        @endpush()
                    @endif
                    @endforeach
                @else
                @vite(['resources/css/app.css', 'resources/js/app.js']) 
                @endif
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            {{-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
     
        @stack('modals')
        @stack('scripts') 
        @livewireScripts
    </body>
</html>