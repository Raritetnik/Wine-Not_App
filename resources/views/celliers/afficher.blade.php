@extends('layouts.app')
@section('content')

<!-- Reste du doc pour visualiser -->
<div class="conteneur-de-toute-la-page">
<!-- Bouton pour filtrer carte -->
<!--<div class="filtrer-cartes">
    <label>
        <div class="bouton-filtre">Filtrer</div>
        <input type="checkbox" name="filtre" class="checkbox-filtre">
    </label>
</div>-->
<div class="container mx-auto py-8 px-8 sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
  <div>
      <div class="bg-gray-100 mx-auto flex gap-1 border px-4 py-3 rounded-md justify-between w-[400px] sm:w-[500px]">
        <!-- Nom du cellier -->
        <div class="flex">
          <div class="text-section_title sm:text-xl font-bold mr-3"> Cellier: </div>
          <span class="text-lg font-bold leading-none sm:text-xl md:container md:mx-auto"> {{$cellier->nom}} </span>
          <span class="mr-12"></span>
        </div>
        <div class="container flex ml-auto">
          <!-- Modifier -->
          <div class="flex items-right ml-auto mr-6" onclick="location.href=`{{route('celliers.modifier', $cellier->id)}}`">
            <div class="cursor-pointer mr-0">
              <svg width="23" height="23" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.7349 3.53024H6.72527C4.72124 3.53024 3.71922 3.53024 2.95378 3.92025C2.28048 4.26331 1.73307 4.81072 1.39001 5.48402C1 6.24946 1 7.25148 1 9.25551V19.2747C1 21.2788 1 22.2808 1.39001 23.0462C1.73307 23.7195 2.28048 24.2669 2.95378 24.61C3.71922 25 4.72124 25 6.72527 25H16.7445C18.7485 25 19.7505 25 20.516 24.61C21.1893 24.2669 21.7367 23.7195 22.0798 23.0462C22.4698 22.2808 22.4698 21.2788 22.4698 19.2747V14.2651M8.15656 17.8434H10.1539C10.7374 17.8434 11.0291 17.8434 11.3037 17.7775C11.5471 17.7191 11.7798 17.6227 11.9932 17.4919C12.2339 17.3444 12.4402 17.1381 12.8528 16.7255L24.2589 5.31939C25.247 4.33127 25.247 2.72921 24.2589 1.74109C23.2708 0.752971 21.6687 0.75297 20.6806 1.74109L9.27449 13.1472C8.8619 13.5598 8.65561 13.7661 8.50809 14.0068C8.37729 14.2202 8.28091 14.4529 8.22247 14.6963C8.15656 14.9709 8.15656 15.2626 8.15656 15.8461V17.8434Z" stroke="#ABA08D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
          </div>
          <!-- Filtrer -->
          <div class="flex items-center filtrer-cartes">
            <div class="cursor-pointer ml-auto mr-3">
              <svg class="bouton-filtre" width="30" height="26" viewBox="0 0 30 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M28.8413 1H1.84131L12.6413 13.6133V22.3333L18.0413 25V13.6133L28.8413 1Z" stroke="#ABA08D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <!-- checkbox pour déclencher ouverture du filtre -->
              <label>
                <input type="checkbox" name="filtre" class="checkbox-filtre">
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- *** Bouton modifié remplacé par icône ***
    <div class="pb-6 text-center w-full">
    <a href="{{route('celliers.modifier', $cellier->id)}}" class="inline-flex items-center justify-center space-x-2 bg-accent_wine hover:accent_wine-80 text-main font-bold ml-2 py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <div><span class="ml-2 py-8"></span>Modifier cellier</div>
    </a>
  </div>-->

  <!-- ***Formulaire d'ajout de bouteille déplacé dans une autre page ***
    <div>-->
    <!-- Form d'ajout de bouteilles dans ce cellier-->
   <!-- <form method="post" enctype="multipart/form-data"> -->
     <!-- passer la méthode PUT et aussi le token expired réémission du token-->
      <!-- @csrf
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
  </div> -->
  <!--<section class="px-6 flex flex-col items-center">
    @foreach ($bouteilles as $bouteille)
     carte 
    <div class="mb-2">
        <v-bouteille :bouteille="{{ $bouteille }}" :liste="{{ $liste }}"/>
    </div>
    @endforeach
</section>-->
</div>

<!-- Affichage filtres et des cartes des bouteilles présentes dans ce cellier -->
<v-filtre :type="{{$type}}" :pays="{{$pays}}" :cellier="{{$cellier}}" :bouteilles="{{$bouteilles}}" :liste="{{$liste}}"/>
</div>

@endsection