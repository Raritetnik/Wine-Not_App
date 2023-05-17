@extends('layouts.app')
@section('content')
<div class="px-6 py-10 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
  <div class="pb-6 text-center w-full">
    <h2 class="mb-2 text-accent_wine text-2xl font-bold leading-none sm:text-3xl">Mes Celliers</h2>
  </div>
  <div id="section-celliers" class="py-5 flex flex-col items-center mx-auto mb-8 lg:row-gap-8 justify-center">
        <!-- carte -->
    @foreach($celliers as $cellier)
      <!-- Carte de cellier -->
      <div class="mb-2 w-full justify-center">
        <v-cellier :cellier="{{ $cellier }}" :quantitecelliers="{{ $quantitecelliers }}"/>
      </div>
    @endforeach

  <div class="mt-7 flex justify-center items-center">
  <a
      href="{{route('celliers.creer')}}"
      class="inline-flex items-center justify-center min-w-max py-2.5 px-6 font-medium tracking-wide text-white bg-accent_wine transition-colors duration-200 rounded border border-accent_wine hover:bg-white hover:text-accent_wine focus:outline-none"
    >
      Ajouter un cellier
    </a>
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
                <h3 class="mb-1 text-lg font-normal text-black">Etes-vous sûr(e) de vouloir supprimer?</h3>
                <h4 class="mb-2 text-red-600">Tous les vins à l'intérieur seront supprimer</h4>
                <form action="{{ route('supprimer.cellier') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="CellierID" name="CellierID" value="0">
                    <input type="hidden" name="redirect" value="true">
                    <button type="submit" data-modal-hide="popup-modal" class="p-2 px-4 bg-green-600 text-white rounded" type="button" alt="delete">Oui</button>
                    <button data-modal-hide="popup-modal" class="p-2 px-4 bg-gray-800 text-white rounded" type="button" id="no_popup-modal">No</button>
                </form>
            </div>
        </div>
    </div>
  </div>
  <!-- bouton d'ajout de bouteille -->
  <div class="add_btn absolute right-5 bottom-0 z-50">
    <a href="{{ route('bouteille.create') }}">
        <div class="shadow-md h-16 w-16 rounded-full transition-colors duration-200 flex justify-center cursor-pointer p-2.5 bg-accent_wine_light hover:bg-accent_wine text-main"><img class="absolute left-6 h-11 self-center" src="{{asset('img/svg/bouteille-plus.svg')}}" alt="add-button"></div>
    </a>
  </div>
</div>


@endsection


