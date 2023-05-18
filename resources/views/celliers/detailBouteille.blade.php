@extends('layouts.app')
@section('content')

<div class="px-4 py-2 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <!-- Fiche Detaile Bouteille -->
 @if ($errors->has('unCellier'))
  <div class="fixed inset-0 flex flex-col font-sans gap-3 items-center justify-center bg-gray-100">
    <div class="bg-gray-100 py-3 px-3">
      <ul>
        <li class="text-accent_wine  font-medium text-center text-lg min-w-[300px]">{{ $errors->first('unCellier') }}</li>
      </ul>
    </div>
    <a href="{{ url()->previous() }}" class="hover:opacity-80  transition-opacity font-medium text-accent_wine duration-200 ease-in-out">Retourner</a>
  </div>
@endif
<!-- Modal Box -->
    <div id="popup-modal" tabindex="-1" class="bg-black bg-opacity-40 fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full ">
        <div class="relative w-full max-w-md max-h-full rounded-lg border border-accent_wine top-[50%] translate-y-[-50%] left-[50%] translate-x-[-50%]">
            <div class="relative bg-white rounded-lg">
                <button type="button" id="close_popup-modal" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Fermer</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 text-red-500 w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-black">Etes-vous sûr(e) de vouloir supprimer?</h3>
                    <form action="{{ route('supprimer.bouteille') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="BouteilleID" name="BouteilleID" value="{{ $bouteille->id }}">
                        <input type="hidden" id="CellierID" name="CellierID" value="{{ $bouteille->vino_cellier_id }}">
                        <button type="submit" data-modal-hide="popup-modal" class="p-2 px-4 bg-green-600 text-white rounded" type="button" alt="delete">Oui</button>
                        <button data-modal-hide="popup-modal" class="p-2 px-4 bg-gray-800 text-white rounded" type="button" id="no_popup-modal">No</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
   
   @include('celliers.deplacerBouteille', ['vino_cellier' => $bouteille->vino_cellier_id, 'bouteille_par_cellier' => $bouteille->id])
    <div class="max-w-screen-lg flex justify-between items-center gap-5 px-3 mx-auto">
        <a href="{{ route('celliers.afficher', ['cellier' => $bouteille->vino_cellier_id]) }}" class=" hover:opacity-80"><img class="w-5 max-w-md" src="{{asset('img/svg/arrowL-w.svg')}}" alt="back"></a>
        <h5 class="sm:text-2xl text-accent_wine text-xl font-bold text-right leading-6">{{$bouteille -> nom}}</h5>
    </div>
    <div class="max-w-screen-lg mx-auto rounded-lg overflow-hidden mt-6 mb-7 px-3">
            <div class="rounded-lg flex flex-col md:flex-row items-center mb-2">

            <div class="md:rounded-l-lg md:rounded-tr-none flex-shrink-0 md:w-1/2">
                @if ($bouteille->url_img)
                <img src="{{ explode('?', $bouteille->url_img)[0] }}" class="object-cover mx-auto max-h-[350px] h-full mt-2 p-3" alt="bouteil de vin">
                @else
                <img src="{{ $bouteille->image ? asset('/storage/uploads/' . $bouteille->image) : asset('/storage/uploads/placeholder.png') }}" class="object-cover mx-auto max-h-[350px] h-full mt-2 p-3" alt="bouteille de vin">

                @endif
            </div>

            <div class="bg-gray-50 rounded-b-lg md:rounded-r-lg md:rounded-bl-none flex-grow flex flex-col">
                <div class="p-5">
                    <div class="flex items-start justify-between mb-3 gap-3 w-full">
                    <div class="flex flex-wrap items-baseline gap-2">
                        <span class="text-m font-semibold text-section_title">Cellier:</span>
                        <span class="text-article_title text-lg font-medium">{{$bouteille->cellier}}</span>
                    </div>
                    <div class="flex flex-wrap items-baseline gap-2">
                        <span class="text-m font-semibold text-section_title">Date d'ajout:</span> 
                        <span type="text" class="text-article_title text-lg font-medium" >{{$bouteille->date_achat ?? ''}}</span>
                    </div>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div class="py-4 flex justify-start gap-5 items-center">
                            <p class="text-m text-section_title font-semibold">Quantité:</p>
                            <!-- Compteur -->

                            <!-- ici va le compteur -->
                            <v-compteur :nbbouteille="{{ $bouteille->quantiteBouteille }}" :id="{{ $bouteille->vino_bouteille_id }}" :idCellier="`{{ $bouteille->vino_cellier_id }}`" />

                            <!-- end Comteur -->

                        </div>
                        <div class="flex justify-between gap-3 pb-4 items-center w-full">
                            <div class="flex gap-2 flex-wrap items-center">
                                <p for="prix" class="text-m text-section_title font-semibold flex-shrink-0">Prix de Bouteille:</p>
                                <span id="prix" class="text-article_title text-lg">${{$bouteille->prix_saq}}</span>
                            </div>

                            <div class="flex flex-wrap gap-2 items-center">
                                <p class="text-m text-section_title font-semibold">Valeur Total:</p>
                                <span id="total" class="text-article_title text-lg">${{$bouteille->total}}</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center gap-3 pb-4 w-full">
                            <div class="flex flex-wrap gap-2 items-center">
                                <p class="text-m text-section_title font-semibold">Pays:</label>
                                <span id="pays" class="text-article_title font-medium text-lg">{{$bouteille->pays}}</span>
                            </div>

                            <div class="flex flex-wrap gap-2 items-center">
                                <p class="text-m text-section_title font-semibold">Volume:</p>
                                <span id="format" class="text-article_title text-lg">{{$bouteille->format}}</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center pb-4 gap-3 w-full">
                            <div class="flex flex-wrap gap-2 items-center">
                                <p class="text-m text-section_title font-semibold">Type:</p>
                                <span id="type" class="text-article_title text-lg">{{$bouteille->type}}</span>
                            </div>

                            <div class="flex flex-wrap gap-2 items-center">
                                <p class="text-m text-section_title font-semibold">Millésime:</p>
                                <span id="annee" class="text-article_title text-lg">{{$bouteille->millesime}}</span>
                            </div>
                        </div>

                        <div class="gap-2 flex flex-col pb-4">
                            <span id="note" class="text-m text-section_title font-medium">Évaluation (cliquer pour évaluer)</span>
                            <v-note :note="{{$bouteille->note}}" :bouteille="{{$bouteille->vino_bouteille_id}}" :total-stars="5"></v-note>
                        </div>
                        @if($bouteille->url_saq)
                        <div class="flex flex-col pb-4">
                            <a href="{{$bouteille->url_saq}}" class="text-lg text-accent_wine hover:text-gray-600 font-bold">Le lien SAQ </a>
                        </div>
                        @endif
                    </div>
                </div>
              
                <div class="flex justify-start items-center pt-5 pb-4 gap-10 px-5 mt-auto">
                    @if (count(auth()->user()->celliers) > 1)
                    <button type="button" id="move_modal" class="py-2 px-4 rounded-md transition-colors duration-200 bg-accent_wine text-main font-medium hover:bg-transparent hover:border-accent_wine border hover:text-accent_wine">Déplacer</button>
                    @endif
                    <button id="open_popup-modal" type="button" class="transition-opacity duration-300 hover:opacity-75"><img src="{{asset('img/svg/trash.svg')}}" alt="delete"></button>
                </div>
            </div>
          </div>
        
    </div>
    <!-- fin fiche -->
</div>
  <!-- bouton d'ajout de bouteille -->
  <div class="add_btn fixed right-5 btn-bouteille z-50">
    <a href="{{ route('bouteille.create') }}">
        <div class="shadow-md h-16 w-16 rounded-full transition-colors duration-200 flex justify-center cursor-pointer p-2.5 bg-accent_wine_light hover:bg-accent_wine text-main"><img class="absolute left-6 h-11 self-center" src="{{asset('img/svg/bouteille-plus.svg')}}" alt="add-button"></div>
    </a>
  </div>
@endsection