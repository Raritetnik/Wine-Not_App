@extends('layouts.app')
@section('content')
<div class="flex gap-10 justify-between max-w-[600px] lg:max-w-[1050px] px-6 mx-auto pt-5 items-center">
  <a href="{{ url()->previous() }}" class="hover:opacity-80 transition-opacity  duration-200 ease-in-out"><img class="h-[30px] sm:min-h-[17px]" src="{{asset('img/svg/back-arrow.svg')}}" alt="back"></a>
</div>

<div class="flex flex-col justify-center mb-7 mt-4">
  <!-- formulaire pas SAQ SAQ -->
  <!-- Form d'ajout de bouteilles dans ce cellier-->
  <section id="form-personal" class="self-center px-6 flex-col w-full lg:w-2/5">

    <form method="post" enctype="multipart/form-data" class="w-full pt-3">
      <!-- ajouter un token pour autoriser la route une seconde fois -->
      @csrf

      <h2 class="text-accent_wine text-xl font-extrabold pb-6">
        Bouteille personnelle
      </h2>
      <div class="w-full mb-5">
        <label for="nom" class="text-section_title text-sm font-bold mb-3">Ajouter une bouteille</label>
        <input type="name" name="nom" id="nom" placeholder="Nom de la bouteille" class="block w-full py-3 px-3 rounded-md border border-accent_wine focus:border-secondary focus:outline-none placeholder-section_title {{ $errors->has('nom') ? 'border-error' : '' }}" value="{{ old('nom') }}" required />
      </div>
      @error('nom')
        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
      @enderror
      <div class="w-full mb-5">
        <label for="img" class="text-section_title text-sm font-bold mb-3">Ajouter une image</label>
        <div class="relative w-full py-3 px-3 rounded-md border border-accent_wine focus:border-secondary focus:outline-none">
          <input id="img" type="file" class="opacity-0 absolute z-50 w-full py-3 px-3 border border-accent_wine rounded-lg cursor-pointer" name="image">
          <div class="flex justify-between gap-3  sm:text-md cursor-pointer">
            <span class="text-section_title" id="file-name">Choisir une image</span><img id="imgForm" src="{{ asset('img/svg/addPhoto.svg') }}" alt="add-image">
          </div>
        </div>
      </div>
      <div class="w-full mb-3">
        <label for="millesime" class="text-section_title text-sm font-bold mb-3">Millésime</label>
        <div class="flex flex-col md:flex-row md:space-x-4">
          <input type="number" class="w-full placeholder-section_title py-3 px-3 rounded-md border border-accent_wine focus:border-secondary focus:outline-none" name="millesime" id="millesime" max="{{ date('Y') }}" placeholder="Entrer l'année du vin">
        </div>
      </div>

      <div class="mb-2 flex flex-wrap md:flex-nowrap gap-3">
        <div class="w-full mb-3">
          <label for="date_achat" class="text-section_title text-sm font-bold mb-3">Date d'achat</label>
          <div class="flex flex-col md:flex-row md:space-x-4">
            <input type="date" name="date_achat" id="date_achat" placeholder="Date d'achat" class="w-full placeholder-section_title py-3 px-3 rounded-md border border-accent_wine focus:border-secondary focus:outline-none" value="{{ $dateActuelle->toDateString() }}"/>
          </div>
        </div>
        <div class="w-full mb-3">
          <label for="date_exp" class="text-section_title text-sm font-bold mb-3">Valide jusqu'à</label>
          <div class="flex flex-col md:flex-row md:space-x-4">
            <input type="date" name="garde_jusqua" id="date_exp" placeholder="Valide jusqu'à" class="w-full py-3 px-3 rounded-md border border-accent_wine placeholder-section_title focus:border-secondary focus:outline-none" />
          </div>
        </div>
      </div>
      <div class="mb-2 flex justify-between gap-3">
        <div class="w-1/2 mb-3">
          <label for="quantite" class="text-section_title text-sm font-bold mb-3">Quantité<b class="text-accent_wine"> *</b></label>
          <input type="number" class="w-full py-3 px-3 placeholder-section_title rounded-md border border-accent_wine focus:border-secondary focus:outline-none appearance-none {{ $errors->has('qty') ? 'border-error' : '' }}" name="quantite" id="quantite" min="1" placeholder="Quantité" value="{{ old('qty') }}" required/>

          <!-- {{ $errors->has('qty') ? 'border-error' : '' }} -->
        </div>
        <div class="w-1/2 mb-3">
          <label for="prix" class="text-section_title text-sm font-bold mb-3">$ Prix</label>
          <input type="number" class="w-full py-3 px-3 placeholder-section_title rounded-md border border-accent_wine focus:border-secondary focus:outline-none appearance-none" name="prix_saq" id="prix" min="1" placeholder="Prix par bouteille"/>
        </div>
      </div>
      <div class="mb-2 flex justify-between gap-3">
        <div class="w-1/2 mb-3">
          <label for="cellier" class="text-section_title text-sm font-bold mb-3">Celliers</label>
          <select name="vino_cellier_id" id="cellier" class="w-full block py-3 px-3 bg-transparent bg-gray-50  rounded-md border border-accent_wine focus:border-secondary focus:outline-none" placeholder="Choisissez un cellier" required>
                <option value="" disabled selected hidden>Sélectionnez un cellier</option>
                @foreach($celliers as $cellier)
                  @if(isset($idCellier) && $idCellier == $cellier->id)
                      <option value="{{$cellier->id}}" selected>{{$cellier->nom}}</option>
                  @else
                      <option value="{{$cellier->id}}">{{$cellier->nom}}</option>
                  @endif
                @endforeach
          </select>
        </div>
        <div class="w-1/2 mb-3">

          <label for="pays" class="text-section_title text-sm font-bold mb-3">Pays Producteur</label>
          <select name="pays_id" id="pays" class="w-full text-section_title block py-3 px-3 rounded-md border bg-transparent bg-gray-50 border-accent_wine focus:border-secondary focus:outline-none">
            <option class="text-section_title" value="" disabled selected hidden>Pays</option>
            @foreach($pays as $place)
            <option value="{{$place->id}}">{{ $place->pays }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="flex justify-between gap-3">
        <div class="w-1/2 mb-3">

          <label for="type" class="text-section_title text-sm font-bold mb-3">Type de Vin</label>
          <select name="vino_type_id" id="type" class="w-full text-section_title block py-3 px-3 rounded-md bg-transparent bg-gray-50 border border-accent_wine focus:border-secondary focus:outline-none">
            <option class="text-section_title" value="" disabled selected hidden>Type</option>
            @foreach($types as $type)
            <option value="{{$type->id}}">{{ $type->type }}</option>
            @endforeach
          </select>
        </div>
        <div class="w-1/2  mb-3">

          <label for="format" class="text-section_title text-sm font-bold mb-3">Volume</label>
          <select name="vino_format_id" id="format" class="w-full text-section_title block py-3 px-3  bg-transparent bg-gray-50 rounded-md border border-accent_wine focus:border-secondary focus:outline-none">
            <option class="text-section_title" value="" disabled selected hidden>Format</option>
            @foreach($formats as $format)
            <option value="{{$format->id}}">{{ $format->format }}</option>
            @endforeach
          </select>

        </div>
      </div>
      <div class="mt-7 flex justify-center">
        <input type="submit" class="h-12 py-2 px-6 rounded-md bg-accent_wine text font-medium text-main hover:bg-transparent border hover:border-accent_wine hover:text-accent_wine transition-colors duration-200 ease-in-out" value="Ajouter bouteille personelle" />
      </div>

    </form>
  </section>
</div>
@endsection