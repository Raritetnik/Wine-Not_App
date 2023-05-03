@extends('layouts.app')
@section('content')
<div class="flex gap-10 justify-between max-w-[600px] lg:max-w-[1050px] px-6 mx-auto pt-5 items-center">
  <a href="{{ url()->previous() }}" class="h-[15px] sm:max-h-[12px] hover:opacity-80"><img src="{{asset('img/svg/arrowL-w.svg')}}" alt="add-button"></a>
  <div class="self-end gap-3 flex justify-end items-center">
    <p id="form-p-p" class="text-accent_wine font-bold text-right sm:text-lg text-sm">Ajouter une bouteille non listée à la SAQ?</p>
    <p id="form-p-saq" class="hidden text-accent_wine font-bold sm:text-lg text-sm">Ajouter une bouteille de la SAQ?</p>
    <a id="btn-form" class="transition-all duration-300 ease-in-out items-center flex justify-center cursor-pointer   min-w-[34px] hover:opacity-80 text-main text-5xl"><img id="plus" src="{{asset('img/svg/plus-form.svg')}}" alt="add-button"></a>
  </div>
</div>
<div class="flex flex-col justify-center mb-7 mt-4 w-full">
  <!-- formulaire personnel -->
  @include('bouteille.bouteille_ext')

  <div class="self-center">
    <!-- formulaire SAQ -->
    @include('bouteille.recherche_saq', ['bouteilles' => $bouteilles])
  </div>
</div>
@endsection