<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
      body {
        margin: 0;
        padding: 0;
        font-family: 'Figtree', sans-serif;
        background: url('{{ asset('images/Wallpaper.jpg') }}') center/cover no-repeat;
        height: 100vh;
        display: flex;
        flex-direction: column;
      }

      .top-right {
        position: absolute;
        right: 1.5rem;
        top: 1.5rem;
        display: flex;
        gap: 0.75rem;
      }

      .top-right a {
        padding: 0.5rem 1rem;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        font-weight: 600;
        border-radius: 9999px;
        text-decoration: none;
        transition: background 0.2s ease;
      }
      .top-right a:hover {
        background: rgba(0, 0, 0, 0.7);
      }

      .logo-center {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .logo-center img {
        max-width: 300px;
        width: 80%;
        height: auto;
      }
    </style>
  </head>
  <body>
    @if (Route::has('login'))
      <div class="top-right">
        @auth
          <a href="{{ url('/dashboard') }}">Dashboard</a>
        @else
          <a href="{{ route('login') }}">Log in</a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
          @endif
        @endauth
      </div>
    @endif

    <div class="logo-center">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" />
    </div>
  </body>
</html>