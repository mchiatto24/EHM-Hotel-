{{-- components/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- head stuff here --}}
</head>
<body class="font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        @include('layouts.navigation')

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
