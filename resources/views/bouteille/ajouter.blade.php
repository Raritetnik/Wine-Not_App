@extends('layouts.app')
@section('content')
<header class="mb-8 md:hidden">
  <a href="/" class="text-accent_wine uppercase tracking-wide font-bold">
    <img src="{{ asset('img/svg/logoWn.svg') }}" alt="logo-wineNot" class="mx-auto" width="120">
  </a>
</header>
<div class="flex gap-10 justify-between sm:w-[1000px] w-full px-6 mx-auto pt-4 items-center">
  <a href="{{ url()->previous() }}" class="h-[15px] sm:max-h-[12px] hover:opacity-80"><img src="{{asset('img/svg/arrowL-w.svg')}}" alt="add-button"></a>
  <div class="self-end gap-3 flex justify-end items-center">
    <p id="form-p-p" class="text-accent_wine font-bold text-right sm:text-lg text-sm">Ajouter une bouteille non listée à la SAQ?</p>
    <p id="form-p-saq" class="hidden text-accent_wine font-bold sm:text-lg text-sm">Ajouter une bouteille de la SAQ?</p>
    <button id="btn-form" class="transition-all duration-300 ease-in-out items-center shadow-md flex justify-center sm:rounded-md rounded-md cursor-pointer sm:w-10  sm:h-10 w-8 h-8  min-w-[34px] py-1 px-1 bg-accent_wine_light  hover:bg-accent_wine text-main text-5xl"><img id="plus" src="{{asset('img/svg/plus.svg')}}" alt="add-button"></button>
  </div>
</div>
<div class="flex flex-col justify-center mb-7 mt-2 w-full">
  <!-- formulaire personnel -->
  @include('bouteille.bouteille_ext')

  <div class="self-center">
    <!-- formulaire SAQ -->
    @include('bouteille.recherche_saq', ['bouteilles' => $bouteilles])
  </div>
</div>
@endsection