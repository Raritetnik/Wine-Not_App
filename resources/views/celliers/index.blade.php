@extends('layouts.app')
@section('content')
<div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
  <div class="pb-6 text-center w-full">
    <h2 class="mb-2 text-3xl font-bold leading-none sm:text-4xl">Mes Celliers</h2>
  </div>
  <div class="py-16 grid gap-8 row-gap-5 mb-8 lg:grid-cols-3 lg:row-gap-8 justify-center">
    @foreach($celliers as $cellier)
      <!-- Carte de cellier -->
      <span class="m-0 p-0 flex justify-center">
        <v-cellier :cellier="{{ $cellier }}" />
      </span>
    @endforeach
  </article>
  <div class="mb-6 text-center">
    <a
      href="{{route('celliers.creer')}}"
      class="inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide text-accent_wine transition duration-200 rounded shadow-md border border-accent_wine hover:bg-accent_wine hover:text-main focus:shadow-outline focus:outline-none"
    >
      Ajouter un cellier
    </a>
  </div>
  <div class="flex flex-col w-full mb-6 lg:justify-between lg:flex-row md:mb-8">
    <div class="flex items-center mb-5 md:mb-6 group lg:max-w-xl">
      <quote class="font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl">
        <span class="inline-block mb-2">"Je boirai du lait<br class="hidden md:block" />
        quand les vaches brouteront du raisin." - Toulouse-Lautrec</span>
        <div class="h-1 ml-auto duration-300 origin-left transform bg-deep-purple-accent-400 scale-x-30 group-hover:scale-x-100"></div>
      </quote>
    </div>
  </div>
</div>


@endsection


