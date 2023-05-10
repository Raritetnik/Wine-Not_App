@extends('layouts.app')
@section('content')

<!-- Reste du doc pour visualiser -->
<div class="conteneur-de-toute-la-page">
<div class="container mx-auto pb-8 pt-2 sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
  <div class="px-6">
      <div class="bg-gray-100 flex gap-1 border px-4 py-3 rounded-md justify-between w-full max-w-[560px] mx-auto" style="width:100%; padding: 16px;">
        <!-- Nom du cellier -->
        <div class="flex">
          <div class="text-section_title text-lg font-bold mr-3">Cellier: </div>
          <span class="text-lg font-bold sm:text-xl md:container md:mx-auto"> {{$cellier->nom}} </span>
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
</div>
  <!-- Modal Box -->
  <div id="popup-modal" tabindex="-1" class="bg-black bg-opacity-40 fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="relative w-full max-w-md max-h-full rounded-lg border border-accent_wine top-[50%] translate-y-[-50%] left-[50%] translate-x-[-50%]">
        <div class="relative bg-white rounded-lg">
            <button type="button" id="close_popup-modal" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Fermer</span>
            </button>
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 text-red-500 w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="mb-5 text-lg font-normal text-black">Etes-vous sûr(e) de vouloir supprimer?</h3>
                <form action="{{ route('supprimer.bouteille') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="BouteilleID" name="BouteilleID" value="0">
                    <input type="hidden" id="CellierID" name="CellierID" value="0">
                    <input type="hidden" name="redirect" value="true">
                    <button type="submit" data-modal-hide="popup-modal" class="p-2 px-4 bg-green-600 text-white rounded" type="button" alt="delete">Oui</button>
                    <button data-modal-hide="popup-modal" class="p-2 px-4 bg-gray-800 text-white rounded" type="button" id="no_popup-modal">No</button>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- Affichage filtres et des cartes des bouteilles présentes dans ce cellier -->
<v-filtre :type="{{$type}}" :pays="{{$pays}}" :cellier="{{$cellier}}" :bouteilles="{{$bouteilles}}" :liste="{{$liste}}"/>
@endsection