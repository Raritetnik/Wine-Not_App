@extends('layouts.app')
@section('content')

<div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <!-- Fiche Detaile Bouteille -->

    <div class="mx-auto">
        <div class="max-w-screen-lg flex justify-between items-center gap-3 px-3 mx-auto">
            <a href="{{ url()->previous() }}" class=" hover:opacity-80"><img class="h-[15px] sm:min-h-[17px]" src="{{asset('img/svg/arrowL-w.svg')}}" alt="back"></a>
            <h5 class="sm:text-2xl text-accent_wine text-xl font-bold text-right leading-6">{{$bouteille -> nom}}</h5>
        </div>
        <div class="max-w-screen-lg mx-auto rounded-lg overflow-hidden mt-6 mb-7 px-3">

            <div class="rounded-lg flex flex-col md:flex-row mb-2">

                <div class="bg-gray-50 md:rounded-l-lg md:rounded-tr-none flex-shrink-0 md:w-1/2">
                    <img src="{{ $bouteille->url_img }}" class="object-cover mx-auto max-h-[500px] md:h-full mt-2 p-3" alt="bouteil de vin">
                </div>
                <div class="bg-box_color rounded-b-lg md:rounded-r-lg md:rounded-bl-none flex-grow flex flex-col">
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-m font-semibold text-section_title">Cellier: </span>
                            <span class="text-m font-semibold text-section_title">Date d'ajout: <span class="text-article_title text-lg font-medium">{{$bouteille->date_achat ?? ''}}</span></span>
                        </div>
                        <!-- <h5 class="sm:text-2xl text-article_title text-xl font-bold leading-6 mb-4">{{$bouteille -> nom}}</h5> -->

                        <div class="flex flex-col gap-4">
                            <div class="py-4 flex justify-start gap-5 items-center">
                                <span class="text-m text-section_title font-semibold">Quantité</span>
                                <!-- Compteur -->
                                <!-- ici va le compteur -->
                                <v-compteur :nbbouteille="{{ $bouteille->quantiteBouteille }}" :id="{{ $bouteille->vino_bouteille_id }}" />

                                <!-- end Comteur -->

                            </div>
                            <div class="flex justify-between pb-4 items-center">
                                <div class="flex gap-3 flex-wrap items-center">
                                    <span class="text-m text-section_title font-semibold">Prix de Bouteille</span>
                                    <span class="text-article_title text-lg">${{$bouteille ->prix_saq}}</span>
                                </div>

                                <div class="flex flex-wrap gap-3 items-center">
                                    <span class="text-m text-section_title font-semibold">Valeur Total</span>
                                    <span class="text-article_title text-lg">${{$bouteille->total}}</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center pb-4">
                                <div class="flex flex-wrap gap-3 items-center">
                                    <span class="text-m text-section_title font-semibold">Pays</span>
                                    <span class="text-article_title text-lg">{{$bouteille->pays}}</span>
                                </div>

                                <div class="flex flex-wrap gap-3 items-center">
                                    <span class="text-m text-section_title font-semibold">Volume</span>
                                    <span class="text-article_title text-lg">{{$bouteille->format}}</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center pb-4">
                                <div class="flex flex-wrap gap-3 items-center">
                                    <span class="text-m text-section_title font-semibold">Type</span>
                                    <span class="text-article_title text-lg">{{$bouteille->type}}</span>
                                </div>

                                <div class="flex flex-wrap gap-3 items-center">
                                    <span class="text-m text-section_title font-semibold">Millésime</span>
                                    <span class="text-article_title text-lg">{{$bouteille->millesime}}</span>
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
                        <a href="#" class="inline-block border border-accent_wine font-semibold text-accent_wine px-4 py-2 rounded hover:bg-accent_wine  hover:text-main transition-colors duration-300">Déplacer</a>
                        <a href="#" class="inline-block border border-accent_wine  text-accent_wine font-semibold px-4 py-2 rounded  hover:bg-accent_wine hover:text-main transition-colors duration-300">Supprimer</a>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- fin fiche -->
</div>

@endsection


