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
              <label>
                <input type="hidden" nave="vino_cellier_id" value="{{$bouteille->vino_cellier_id}}">
              </label>
            <div class="w-full inline-block mb-5">
              <h2 class="text-accent_wine text-xl font-extrabold pb-6">
                Modifier une bouteille personnelle
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
                class="w-full items-center justify-center h-12 px-6 font-medium tracking-wide text transition duration-200 rounded border border-accent_wine focus:shadow-outline" />
            </div>
            <div class="w-full mb-5">
            <label for="img" class="block text-section_title font-bold mb-2">
              Ajouter une image
            </label>
              <div class="w-full items-center justify-center h-12 py-3 px-6 font-medium tracking-wide text transition duration-200 rounded border border-accent_wine focus:shadow-outline">
                <input
                  id="img"
                  type="file"
                  class="opacity-0 absolute z-50 w-full py-3 px-3 border border-gray-400 rounded-lg cursor-pointer"
                  value="{{ asset('storage/uploads/'.$bouteille->image) }}"
                  placeholder="Choisir une image"
                  name="image">
                <div class="flex justify-between gap-3  sm:text-md cursor-pointer">
                  <span class="block text-section_title" id="file-name">
                    {{ ($bouteille->image == null || $bouteille->image == '' ) ? 'Choisir une image' : $bouteille->image }}
                  </span>
                  <img src="{{ asset('img/svg/addPhoto.svg') }}" alt="add-image">
                    </div>
                  </div>
                </div>
                <div class="mb-2 flex flex-wrap md:flex-nowrap gap-3">
                  <div class="w-full mb-3">
                    <label for="date_achat" class="block text-section_title font-bold mb-2">
                      Date d'achat
                    </label>
                    <div class="flex flex-col md:flex-row md:space-x-4">
                      <input value="{{$bouteille->date_achat}}" type="date" name="date_achat" id="date_achat" placeholder="Date d'achat" class="w-full items-center justify-center h-12 px-6 font-medium tracking-wide text transition duration-200 rounded border border-accent_wine focus:shadow-outline" />
                    </div>
                  </div>
                  <div class="w-full mb-3">
                    <label for="date_exp" class="block text-section_title font-bold mb-2">
                      Valide jusqu'à
                    </label>
                    <div class="flex flex-col md:flex-row md:space-x-4">
                      <input value="{{$bouteille->garde_jusqua}}" type="date" name="garde_jusqua" id="date_exp" placeholder="Valide jusqu'à" class="w-full items-center justify-center h-12 px-6 font-medium tracking-wide text transition duration-200 rounded border border-accent_wine focus:shadow-outline" />
                    </div>
                  </div>
                </div>
                <div class="mb-2 flex justify-between gap-3">
                  <div class="w-1/2 mb-3">
                    <label for="quantite" class="block text-section_title font-bold mb-2">
                      Quantité
                    </label>
                    <input value="{{$bouteille->quantite}}" class="w-full items-center justify-center h-12 px-6 font-medium tracking-wide text transition duration-200 rounded border border-accent_wine focus:shadow-outline" name="quantite" id="quantite" min="1" placeholder="Quantité" />
                  </div>
                  <div class="w-1/2 mb-3">
                    <label for="prix" class="block text-section_title font-bold mb-2">
                      $ Prix
                    </label>
                    <input value="{{$bouteille->prix_saq}}" class="w-full items-center justify-center h-12 px-6 font-medium tracking-wide text transition duration-200 rounded border border-accent_wine focus:shadow-outline" name="prix_saq" id="prix" min="1" placeholder="Prix par bouteille" />
                  </div>
                </div>
                <div class="mb-2 flex justify-between gap-3">
                  <div class="w-1/2 mb-3">
                    <label for="cellier" class="block text-section_title font-bold mb-2">
                      Celliers
                    </label>
                    <select name="vino_cellier_id" id="cellier" class="w-full items-center justify-center h-12 px-6 font-medium tracking-wide text transition duration-200 rounded border border-accent_wine focus:shadow-outline">
                      @foreach($celliers as $index => $cellier)
                      <option value="{{$cellier->id}}">{{$cellier->nom}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="w-1/2 mb-3">
                    <label for="pays" class="block text-section_title font-bold mb-2">
                      Pays Producteur
                    </label>
                    <select name="pays_id" id="pays" class="w-full items-center justify-center h-12 px-6 font-medium tracking-wide text transition duration-200 rounded border border-accent_wine focus:shadow-outline">
                      <option class="text-section_title " value="">
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
                    <select name="vino_type_id" id="type" class="w-full items-center justify-center h-12 px-6 font-medium tracking-wide text transition duration-200 rounded border border-accent_wine focus:shadow-outline">
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
                    <select name="vino_format_id" id="format" class="w-full items-center justify-center h-12 px-6 font-medium tracking-wide text transition duration-200 rounded border border-accent_wine focus:shadow-outline">
                      <option class="text-section_title" value="">Sélectionner format</option>
                      @foreach($formats as $format)
                      <option value="{{$format->id}}">{{ $format->format }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="mb-4 py-4 flex justify-between gap-5">
                  <div class="w-full">
                    <a href="{{ url()->previous() }}" class=" hover:opacity-80">
                      <button type="button" class="h-12 py-3 px-6 rounded transition-colors tracking-wide border-accent_wine duration-200  text-accent_wine font-medium hover:bg-accent_wine  border hover:text-main">Retourner</button>
                  </div>
                  <div class="w-full">
                    <div style="text-align: right;">
                      <input type="submit" class="h-12 py-3 px-6 font-medium tracking-wide text-main transition-colors duration-200 rounded-md border bg-accent_wine hover:border-accent_wine hover:bg-transparent hover:text-accent_wine  focus:outline-none" value="Modifier">
                    </div>
                  </div>
                </div>


              </form>
      </section>
</main>
</div>
<!-- bouton d'ajout de bouteille -->
<div class="add_btn fixed right-5 btn-bouteille z-50">
  <a href="{{ route('bouteille.create') }}">
    <div class="shadow-md h-16 w-16 rounded-full transition-colors duration-200 flex justify-center cursor-pointer p-2.5 bg-accent_wine_light hover:bg-accent_wine text-main"><img class="absolute left-6 h-11 self-center" src="{{asset('img/svg/bouteille-plus.svg')}}" alt="add-button"></div>
  </a>
</div>
@endsection