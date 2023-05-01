@extends('layouts.app')
@section('content')

<div class="flex flex-col justify-center mb-7 mt-5 w-full">
  
  <div class="self-center">
  <div class=" flex gap-3 ps-6  sm:justify-between">
    <p class="text-section_title font-semibold sm:max-w-[50ch]  text-lg">Ajouter une bouteille non listée à la SAQ?</p>
    <div class="flex items-center shadow-md text-center rounded-lg  cursor-pointer w-12 max-h-[45px] py-3 px-3 bg-accent_wine_light mr-3 hover:bg-accent_wine text-main text-5xl"><img src="{{asset('img/svg/plus.svg')}}" alt="add-button"></div>
  </div>
    @include('bouteille.recherche_saq')
  </div>
</div>
@endsection









