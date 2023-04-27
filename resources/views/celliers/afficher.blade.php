@extends('layouts.app')
@section('content')

<!-- Reste du doc pour visualiser -->
<div class="conteneur-de-toute-la-page">
        <!-- Bouton pour filtrer carte -->
        <div class="filtrer-cartes">
            <label>
                <div class="bouton-filtre">Filtre</div>
                <input type="checkbox" name="filtre" class="checkbox-filtre">
            </label>
        </div>
<div class="container mx-auto py-8 px-8 sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
  <!-- Redirection vers modifier les infos du cellier -->
  <div class="pb-6 text-center w-full">
    <h3 class="mb-2 text-3xl font-bold leading-none sm:text-2xl">
      {{$cellier->nom}}
    </h3>
  </div>
  <div class="pb-6 text-center w-full">
    <a href="{{route('celliers.modifier', $cellier->id)}}" class="inline-flex items-center justify-center space-x-2 py-3 px-4 bg-accent_wine hover:accent_wine-80 text-main font-bold ml-2 py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <div><span class="ml-2 py-8"></span>Modifier cellier</div>
    </a>
  </div>
  <!--<div>-->
    <!-- Form d'ajout de bouteilles dans ce cellier-->
   <form method="post" enctype="multipart/form-data">
     <!-- passer la méthode PUT et aussi le token expired réémission du token-->
      @csrf
      @method('PUT')
     <div class="w-full">
        <h2 class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nom">
          Ajouter une bouteille
        </h2>
      </div>
      <section class="flex flex-wrap border-b-2 pb-6 border-accent_wine">
        <div class="w-1/2 flex">
          <v-recherche />
        </div>
        <div class="w-1/2 flex flex-col">
          <label>
            <input id="quantite" name="quantite" class="w-full appearance-none bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="Quantité de bouteilles à ajouter">
          </label>
          <label>
            <input id="date_achat" name="date_achat" class="w-full appearance-none bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="date" placeholder="Garde jusqu'à quand">
          </label>
          <label>
            <input id="garde_jusqua" name="garde_jusqua" class="w-full appearance-none bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="date" placeholder="Garde jusqu'à quand">
          </label>
          <label>
            <input id="millesime" name="millesime" class="w-full appearance-none bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="Millésime">
          </label>
          <label>
            <input class="inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-accent_wine transition duration-200 rounded shadow-md border border-accent_wine hover:bg-accent_wine hover:text-main focus:shadow-outline focus:outline-none" type="submit" value="Ajouter au cellier">
          </label>
        </div>
    </form>
  </div>
  <section class="px-6 flex flex-col items-center">
    @foreach ($bouteilles as $bouteille)
    <!-- carte -->
    <div class="mb-2">
        <v-bouteille :bouteille="{{ $bouteille }}" :liste="{{ $liste }}"/>
    </div>
    @endforeach
</section>
</div>
<v-filtre :type="{{$type}}" :pays="{{$pays}}" :cellier="{{$cellier}}" :bouteilles="{{$bouteillesJulie}}"/>
</div>

@endsection