@extends('layouts.app')
@section('content')

<main class="py-4">
<div class="px-4 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
  <div class="container mx-auto">
    <section class="mx-4 px-6 flex flex-col mb-4">
      <div class="flex flex-col space-y-4 md:flex-row md:space-x-6 md:space-y-0">
        <div class="">
          <div class="">
              <form method="post" enctype="multipart/form-data" class="w-full pt-3">
              @csrf
              @method('PUT')
            <div class="w-full mb-5">
              <h2 class="text-accent_wine text-xl font-extrabold pb-6">
                   Modifier Bouteille Personnelle
              </h2>
              <label for="nom" class="block text-section_title font-bold mb-2">
                Nom de la bouteille
              </label>
              <input 
                value="{{$bouteille->nom}}" 
                type="text" 
                name="nom" 
                id="nom" 
                placeholder="Entrez le nom de la bouteille" 
                class="block w-full py-3 px-3 rounded-md border border-gray-300 focus:border-secondary focus:outline-none placeholder-section_title" />
            </div>
          <!--
            *** 3e sprint ***
            <div class="w-full mb-5">
            <label for="img" class="block text-section_title font-bold mb-2">
              Ajouter une image
            </label>
              <div class="block relative w-full py-3 px-3 rounded-md border border-gray-300 focus:border-secondary focus:outline-none">
                <input 
                  id="img" 
                  type="file" 
                  class="opacity-0 absolute z-50 w-full py-3 px-3 border border-gray-400 rounded-lg cursor-pointer" 
                  name="image">
                <div class="flex justify-between gap-3  sm:text-md cursor-pointer">
                  <span class="block text-section_title" id="file-name">
                    Choisir une image
                  </span>
                  <img src="{{ asset('img/svg/addPhoto.svg') }}" alt="add-image">
                </div>
              </div>
          </div>-->
          <div class="mb-2 flex flex-wrap md:flex-nowrap gap-3">
            <div class="w-full mb-3">
              <label for="date_achat" class="block text-section_title font-bold mb-2">
                Date d'achat
              </label>
              <div class="flex flex-col md:flex-row md:space-x-4">
                <input 
                  value="{{$bouteille->date_achat}}" 
                  type="date" name="date_achat" 
                  id="date_achat" 
                  placeholder="Date d'achat" 
                  class="block w-full placeholder-section_title py-3 px-3 rounded-md border border-gray-300 focus:border-secondary focus:outline-none" />
              </div>
            </div>
            <div class="w-full mb-3">
              <label for="date_exp" class="block text-section_title font-bold mb-2">
                Valide jusqu'à
              </label>
              <div class="flex flex-col md:flex-row md:space-x-4">
                <input 
                  value="{{$bouteille->garde_jusqua}}" 
                  type="date" 
                  name="garde_jusqua" 
                  id="date_exp" 
                  placeholder="Valide jusqu'à" 
                  class="block w-full py-3 px-3 rounded-md border border-gray-300 placeholder-section_title focus:border-secondary focus:outline-none" />
              </div>
            </div>
          </div>
          <div class="mb-2 flex justify-between gap-3">
            <div class="w-1/2 mb-3">
              <label for="quantite" class="block text-section_title font-bold mb-2">
                Quantité
              </label>
              <input 
                value="{{$bouteille->quantite}}" 
                class="block w-full py-3 px-3 placeholder-section_title rounded-md border border-gray-300 focus:border-secondary focus:outline-none appearance-none" 
                name="quantite" 
                id="quantite" 
                min="1" 
                placeholder="Quantité">
              </input>
            </div>
            <div class="w-1/2 mb-3">
              <label for="prix" class="block text-section_title font-bold mb-2">
                $ Prix
              </label>
              <input 
                value="{{$bouteille->prix_saq}}"
                class="block w-full py-3 px-3 placeholder-section_title rounded-md border border-gray-300 focus:border-secondary focus:outline-none appearance-none"
                name="prix_saq" 
                id="prix" 
                min="1" 
                placeholder="Prix par bouteille">
              </input>
            </div>
          </div>
          <div class="mb-2 flex justify-between gap-3">
            <div class="w-1/2 mb-3">
              <label for="cellier" class="block text-section_title font-bold mb-2">
                Celliers
              </label>
              <select 
                name="vino_cellier_id" 
                id="cellier" 
                class="w-full block py-3 px-3 bg-transparent bg-gray-50  rounded-md border border-gray-300 focus:border-secondary focus:outline-none">
                @foreach($celliers as $index => $cellier)
                <option value="{{$cellier->id}}">{{$cellier->nom}}</option>
                @endforeach
              </select>
            </div>
            <div class="w-1/2 mb-3">
              <label for="pays" class="block text-section_title font-bold mb-2">
                Pays Producteur
              </label>
              <select 
                name="pays_id" 
                id="pays" 
                class="w-full text-section_title block py-3 px-3 rounded-md border bg-transparent bg-gray-50 border-gray-300 focus:border-secondary focus:outline-none">
                  <option class="text-section_title" value="">
                    Sélectionner Pays
                  </option>
                @foreach($pays as $place)
                <option value="{{$place->id}}">{{ $place->pays }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="flex justify-between gap-3">
            <div class="w-1/2 mb-3">
              <label for="type" class="block text-section_title font-bold mb-2">
                Type de Vin
              </label>
              <select 
                name="vino_type_id" 
                id="type" 
                class="w-full text-section_title block py-3 px-3 rounded-md bg-transparent bg-gray-50 border border-gray-300 focus:border-secondary focus:outline-none">
                <option class="text-section_title" value="">Sélectionner type</option>
                @foreach($types as $type)
                <option value="{{$type->id}}">{{ $type->type }}</option>
                @endforeach
              </select>
            </div>
            <div class="w-1/2  mb-3">
              <label for="format" class="block text-section_title font-bold mb-2">
                Volume
              </label>
              <select 
                name="vino_format_id" 
                id="format" 
                class="w-full text-section_title block py-3 px-3  bg-transparent bg-gray-50 rounded-md border border-gray-300 focus:border-secondary focus:outline-none">
                <option class="text-section_title" value="">Sélectionner Pays</option>
                @foreach($formats as $format)
                <option value="{{$format->id}}">{{ $format->format }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="mt-7 flex">
            <!--<div class="w-full"><a href="{{ url()->previous() }}" class=" hover:opacity-80">
              <button type="button" class="w-1/4 px-1 py-1.5 rounded-md bg-secondary bg-accent_wine text-lg font-medium text-main text-align: center hover:bg-transparent border hover:border-secondary  cursor-pointer hover:text-secondary transition duration-300 ease-in-out" >Retour</button>
            </div>-->
            <div class="w-full">
              <div style="text-align: right; padding-right: 1rem;">
                <input type="submit" class="px-2 py-1.5 rounded-md bg-secondary text-lg font-medium text-main text-align: center hover:bg-transparent border hover:border-secondary  cursor-pointer hover:text-secondary transition duration-300 ease-in-out" value="Modifier">
              </div>
            </div>
          </div>
          
    
        </form>
  </section>
</main>
</div>
  @endsection