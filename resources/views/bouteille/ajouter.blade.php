@extends('layouts.app')
@section('content')

<div class="containe flex justify-center">
  <!-- <header class="mb-8">
      <a href="/" class="text-accent_wine uppercase tracking-wide font-bold">
        <img src="{{ asset('img/svg/logoWn.svg') }}" alt="logo-wineNot" class="mx-auto" width="120">
      </a>
    </header> -->
  <section class="px-6 flex flex-col mb-4">

    <form  method="post" enctype="multipart/form-data" class="w-full">
      <!-- ajouter un token pour autoriser la route une seconde fois -->
      @csrf
      <div class="w-full mb-3">
        <label for="nom" class="block text-gray-700 font-bold mb-2">Ajoutez une bouteille</label>
        <input type="nom" name="nom" id="nom" placeholder="Nom de la bouteille" class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500" />
      </div>
      <div class="w-full mb-3">
        <label for="img" class="block text-gray-700 font-bold mb-2">Ajouter une image</label>
        <div class="relative">
          <input id="img" type="file" class="opacity-0 absolute z-50 w-full py-2 px-3 border border-gray-400 rounded-lg cursor-pointer" name="image">
          <div class="w-full py-2 px-3 border border-gray-300 rounded-md focus-within:border-accent_wine focus-within:ring-1 focus-within:ring-accent_wine focus-within:outline-none sm:text-md cursor-pointer">
            <span class="text-section_title">Choisir un fichier</span>
          </div>
        </div>
      </div>

      <div class="w-full mb-3">
        <label for="quantite" class="block text-gray-700 font-bold mb-2">Quantité</label>
        <input class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none" name="quantite" id="quantite" min="1" placeholder="Quantité">
        </input>
      </div>
      <div class="mb-3 flex md:flex-wrap gap-3">
        <!-- <div class="mb-6 flex flex-col gap-3"> -->
        <div class="w-full">
          <label for="date_achat" class="block text-gray-700 font-bold mb-2">Date d'achat</label>
          <div class="flex flex-col md:flex-row md:space-x-4">
            <input type="date" name="date_achat" id="date_achat" placeholder="Date d'achat" class="block  py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none md:mb-0" />
          </div>
        </div>
        <!-- <div class="mb-6 flex flex-col gap-3"> -->
        <div class="w-full">
          <label for="date_exp" class="block text-gray-700 font-bold mb-2">Valide jusqu'à</label>
          <div class="flex flex-col md:flex-row md:space-x-4">
            <input type="date" name="garde_jusqua" id="date_exp" placeholder="Valide jusqu'à" class="block py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none md:mb-0" />
          </div>
        </div>
      </div>

      <div class="mb-3">

        <label for="cellier" class="block text-gray-700 font-bold mb-2">Celliers</label>
        <select name="vino_cellier_id" id="cellier" class="block py-2 px-3 rounded-md border border-gray-300 focus:border-accent_wine focus:outline-none">
          <option value="Selectionner Cellier"></option>
          @foreach($celliers as $cellier)
          <option value="{{$cellier->id}}">{{ $cellier->nom }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">

        <label for="pays" class="block text-gray-700 font-bold mb-2">Pays Producteur</label>
        <select name="pays_id" id="pays" class="block py-2 px-3 rounded-md border border-gray-300 focus:border-accent_wine focus:outline-none">
          <option value="Selectionner Pays"></option>
          @foreach($pays as $place)
          <option value="{{$place->id}}">{{ $place->pays }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">

        <label for="type" class="block text-gray-700 font-bold mb-2">Quel type de Vin</label>
        <select name="vino_type_id" id="type" class="block py-2 px-3 rounded-md border border-gray-300 focus:border-accent_wine focus:outline-none">
          <option value="Selectionner type"></option>
          @foreach($types as $type)
          <option value="{{$type->id}}">{{ $type->type }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">

        <label for="format" class="block text-gray-700 font-bold mb-2">Celliers</label>
        <select name="vino_format_id" id="format" class="block py-2 px-3 rounded-md border border-gray-300 focus:border-accent_wine focus:outline-none">
          <option value="Selectionner Cellier"></option>
          @foreach($formats as $format)
          <option value="{{$format->id}}">{{ $format->format }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="sm:w-full mt-3 px-7 py-3 rounded-lg bg-accent_wine text-lg font-medium text-main hover:bg-transparent border hover:border-accent_wine hover:text-accent_wine transition duration-300 ease-in-out">Ajouter la bouteille</button>

    </form>
  </section>
</div>



@endsection