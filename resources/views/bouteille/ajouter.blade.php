@extends('layouts.app')
@section('content')
<div class="flex gap-10 justify-between max-w-[600px] lg:max-w-[1050px] px-6 mx-auto pt-5 items-center">
  <a href="{{ route('celliers.index') }}" class="hover:opacity-80 transition-opacity  duration-200 ease-in-out">
    <img class="h-[15px] sm:min-h-[17px]" src="{{asset('img/svg/arrowL-w.svg')}}" alt="back"></a>
  <div id="btn-form" class="self-end gap-3 flex justify-end items-center cursor-pointer font-sans  hover:opacity-80 transition-opacity  duration-200 ease-in-out">
    <p id="form-p-p" class="text-accent_wine font-medium text-right sm:text-lg text-sm">Ajouter une bouteille non listée à la SAQ</p>
    <p id="form-p-saq" class="hidden text-accent_wine text-right font-medium sm:text-lg text-sm">Ajouter une bouteille de la SAQ</p>
  </div>
</div>
@if ($errors->any())
    <div class="bg-gray-100 border border-accent_wine text-red-500 px-4 py-3 rounded mt-5 max-w-[550px] mx-auto" role="alert">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error == 'validation.required' ? 'Choisissez une bouteille dans les résultats de recherche' : $error}}</li>
            @endforeach
        </ul>

    </div>
@endif

<div class="flex flex-col justify-center mb-7 mt-4 w-full">
  <!-- formulaire personnel -->
  @include('bouteille.bouteille_ext')

  <div class="self-center">
    <!-- formulaire SAQ -->
    @include('bouteille.recherche_saq', ['bouteilles' => $bouteilles])
  </div>
</div>
@endsection