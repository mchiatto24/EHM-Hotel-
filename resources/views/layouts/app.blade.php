<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>{{ config('app.name', 'EHM System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
          rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body class="font-sans antialiased">
  <div class="flex h-screen overflow-hidden">
    {{-- SIDEBAR --}}
    @include('layouts.navigation')

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col overflow-hidden">
      @isset($header)
        <header class="bg-gray-800 text-white px-6 py-4">
          <h2 class="text-lg font-medium">{{ $header }}</h2>
        </header>
      @endisset

      <main class="flex-1 overflow-y-auto bg-gray-900 p-6">
        {{ $slot }}
      </main>
    </div>
  </div>
</body>
</html>