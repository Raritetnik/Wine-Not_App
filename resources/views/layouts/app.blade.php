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
  <!--<script src="{{ asset('js/filtreVanille.js') }}" defer></script>-->
  <script src="{{ asset('js/modalBox.js') }}" defer></script>


  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>

  <!-- Symbols -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/cellier.css') }}" rel="stylesheet">
  <link href="{{ asset('css/filtre.css') }}" rel="stylesheet">
  <link href="{{ asset('css/etoileNote.css') }}" rel="stylesheet">

</head>

<body>

  <div id="app" class="">
    @include('layouts.nav')
    <main class="py-4 relative min-h-[500px]">
      @yield('content')
    </main>
    <!-- bouton d'ajout de bouteille -->
    @if(request()->route()->getName() != 'bouteille.create')
    <div class="add_btn absolute right-5 bottom-5 z-50 ">
      <a href="{{ route('bouteille.create') }}">
        <div class=" shadow-md text-center h-12 w-12 rounded-lg flex justify-center cursor-pointer py-2 px-2 bg-accent_wine_light mr-3 hover:bg-accent_wine text-main text-4xl"><img src="{{asset('img/svg/plus.svg')}}" alt="add-button"></div>
      </a>
    </div>
    @endif
  </div>
  @include('layouts.tabBar')
</body>
</html>


