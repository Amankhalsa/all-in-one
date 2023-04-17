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
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        @stack('scripts') 
    </body>
</html>
