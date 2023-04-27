<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>


  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>


  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/cellier.css') }}" rel="stylesheet">
</head>

<body>
  <div id="app">
    @include('layouts.nav')
    <main class="py-4 relative">
      @yield('content')
      <!-- bouton d'ajout de bouteille -->
      <div class="absolute right-5 bottom-5">
        <a href="{{ route('bouteille.create') }}">
          <div class=" shadow-md text-center rounded-2xl  cursor-pointer py-3 px-6 bg-accent_wine mr-3 hover:bg-accent_wine-80 text-main text-5xl">&#x2b;</div>
        </a>
      </div>
    </main>
</div>
  @include('layouts.footer')
</body>

</html>