<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('img/amigo-fiel-logo.jpg') }}" style="border-radius: 50%;">


    <title>Amigo Fiel</title>
    @include('dependency.style')
</head>
  <body>
      <div class="wrapper">
          <nav class="navbar fixed-top navbar-expand-lg navbar-light text-center bg-white">
          @include('layouts.navbar')
          </nav>
          <main id="content"  style="padding-top: 57px">
              @yield('content')
          </main>
          <footer id="footer">
              @include('layouts.footer')
          </footer>
      </div>
@include('dependency.scripts')
@yield('scripts')
</body>
</html>


