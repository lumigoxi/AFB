<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
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
</body>
</html>


