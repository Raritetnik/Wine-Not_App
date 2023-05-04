@extends('layouts.app')
@section('content')

<div class="px-4 py-7 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <!-- Fiche Detaile Bouteille -->

    <div class="max-w-screen-lg flex justify-between items-center gap-3 px-3 mx-auto">
        <a href="{{ url()->previous() }}" class=" hover:opacity-80"><img class="h-[15px] sm:min-h-[17px]" src="{{asset('img/svg/arrowL-w.svg')}}" alt="back"></a>
        <h5 class="sm:text-2xl text-accent_wine text-xl font-bold text-right leading-6">{{$bouteille -> nom}}</h5>
    </div>
    <div class="max-w-screen-lg mx-auto rounded-lg overflow-hidden mt-6 mb-7 px-3">

        <div class="rounded-lg flex flex-col md:flex-row items-center mb-2">

            <div class="md:rounded-l-lg md:rounded-tr-none flex-shrink-0 md:w-1/2">
                <img src="{{ explode("?",$bouteille->url_img)[0] }}" class="object-cover mx-auto max-h-[500px] h-full mt-2 p-3" alt="bouteil de vin">
            </div>

            <div class="bg-gray-50 rounded-b-lg md:rounded-r-lg md:rounded-bl-none flex-grow flex flex-col">
                <div class="p-5">
                    <div class="flex items-center justify-between mb-3 gap-3 w-full">
                        <label class="text-m font-semibold text-section_title">Cellier:
                            <input type="text" name="" value="{{$bouteille->cellier}}" class="text-article_title text-lg font-medium w-1/2 min-w-[150px] bg-transparent" /></label>
                        <label class="text-m font-semibold text-section_title">Date d'ajout: <input type="text" class="text-article_title text-lg font-medium w-1/2 min-w-[150px] bg-transparent" value="{{$bouteille->date_achat ?? ''}}" /></label>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div class="py-4 flex justify-start gap-5 items-center">
                            <label class="text-m text-section_title font-semibold">Quantité</label>
                            <!-- Compteur -->
                            <!-- ici va le compteur -->

                            <!-- ici va le compteur -->
                            <v-compteur :nbbouteille="{{ $bouteille->quantiteBouteille }}" :id="{{ $bouteille->vino_bouteille_id }}" />

                            <!-- end Comteur -->

                        </div>
                        <div class="flex justify-between gap-3 pb-4 items-center w-full">
                            <div class="flex gap-2 flex-wrap items-center">
                                <label for="prix" class="text-m text-section_title font-semibold w-1/2 min-w-[150px]">Prix de Bouteille</label>
                                <input type="text" name="prix_saq" id="prix" class="text-article_title text-lg w-1/2 min-w-[150px] bg-transparent" value="${{$bouteille ->prix_saq}}" />
                            </div>

                            <div class="flex flex-wrap gap-2 items-center">
                                <label for="total" class="text-m text-section_title font-semibold w-1/2 min-w-[150px]">Valeur Total</label>
                                <input type="text" name="total" id="total" class="text-article_title text-lg w-1/2 min-w-[150px] bg-transparent" value="${{$bouteille->total}}" />
                            </div>
                        </div>
                        <div class="flex justify-between items-center gap-3 pb-4 w-full">
                            <div class="flex flex-wrap gap-2 items-center">
                                <label for="pays" class="text-m text-section_title font-semibold w-1/2 min-w-[150px]">Pays</label>
                                <input type="text" name="pays" id="pays" class="text-article_title text-lg w-1/2 min-w-[150px] bg-transparent" value="{{$bouteille->pays}}" />
                            </div>

                            <div class="flex flex-wrap gap-2 items-center">
                                <label for="format" class="text-m text-section_title font-semibold w-1/2 min-w-[150px]">Volume</label>
                                <input type="text" name="format" id="format" class="text-article_title text-lg w-1/2 min-w-[150px] bg-transparent" value="{{$bouteille->format}}" />
                            </div>
                        </div>
                        <div class="flex justify-between items-center pb-4 gap-3 w-full">
                            <div class="flex flex-wrap gap-2 items-center">
                                <label for="type" class="text-m text-section_title font-semibold w-1/2 min-w-[150px]">Type</label>
                                <input type="text" name="type" id="type" class="text-article_title text-lg w-1/2 min-w-[150px] bg-transparent" value="{{$bouteille->type}}" />
                            </div>

                            <div class="flex flex-wrap gap-2 items-center">
                                <label for="annee" class="text-m text-section_title font-semibold w-1/2 min-w-[150px]">Millésime</label>
                                <input type="text" name="millesime" id="annee" class="text-article_title text-lg w-1/2 min-w-[150px] bg-transparent" value="{{$bouteille->millesime}}" />
                            </div>
                        </div>

                        <!-- <div class="border-b border-accent_wine-50 flex flex-col pb-4">
                                <span id="note" class="text-m text-section_title font-medium">Note</span>
                                <textarea class="hidden resize-none rounded-md py-2 px-3 w-full" id="noteTextarea" name="noteTextarea"> {{$bouteille->note ?? ''}} </textarea>
                            </div> -->
                        @if($bouteille->url_saq)
                        <div class="flex flex-col pb-4">
                            <a href="{{$bouteille->url_saq}}" class="text-lg text-accent_wine hover:text-article_title font-medium">Le lien SAQ </a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="flex flex-row items-center self-center pt-5 pb-4 ps-5 gap-10 mt-auto">
                    <a href="#" class="transition-opacity  duration-300 hover:opacity-75"><img src="{{asset('img/svg/edit.svg')}}" alt="delete"></a>
                    <a href="#" class="transition-opacity duration-300 hover:opacity-75"><img src="{{asset('img/svg/trash.svg')}}" alt="delete"></a>
                </div>


            </div>
        </div>
    </div>
    <!-- fin fiche -->
</div>

@endsection