@extends('layouts.app')
@section('content')
<div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
  <div class="pb-6 text-center w-full">
    <h2 class="mb-3 text-accent_wine text-2xl font-bold leading-none sm:text-3xl">
      Modifier Mon Cellier
    </h2>
  </div>
  <div class="pb-6 text-center w-full">
    <p class="text-article_title mb-4">Remplissez le formulaire suivant pour modifier un cellier.</p>
  </div>
  <form method="post" enctype="multipart/form-data" class="max-w-[560px] mx-auto">
    <!-- ajouter un token pour autoriser la route une seconde fois -->
    <!-- méthode put pour modification -->
    @csrf
    @method('PUT')
    <div class="mb-4">
      <label class="block text-article_title font-medium mb-2" for="nom">
        Nom
      </label>
      <!-- ** important de concerver les input ** -->
      <input value="{{$cellier->nom}}" class="w-full items-center justify-center h-12 px-6 font-medium tracking-wide text-accent_wine transition duration-200 rounded border border-accent_wine focus:shadow-outline" id="nom" name="nom" type="text" placeholder="Entrez le nom du cellier" required>
    </div>
    <div class="mb-4">
      <label class="block text-article_title font-medium mb-2" for="quantite_max">
        Quantité
      </label>
      <input value="{{$cellier->quantite_max}}" class="w-full items-center justify-center h-12 px-6 font-medium tracking-wide text-accent_wine transition duration-200 rounded border border-accent_wine focus:shadow-outline" id="quantite_max" name="quantite_max" type="number" placeholder="Capacité maximale du cellier">
    </div>
    <div class="mb-4">
      <label class="block text-article_title font-medium mb-2" for="description">
        Description
      </label>
      <input type="text" class="w-full h-full items-center justify-center px-6 font-medium tracking-wide text-accent_wine transition duration-200 rounded border border-accent_wine focus:shadow-outline" id="description" name="description" type="text" placeholder="Ajouter un descriptif pour ce cellier" value="{{$cellier->description}}">
    </div>
    <div class="mb-4 py-4 flex justify-start gap-5">
      <a href="{{ route('celliers.afficher', ['cellier' => $cellier->id ]) }}" class="py-2 px-6 rounded transition-colors tracking-wide border-accent_wine duration-200  text-accent_wine font-medium hover:bg-accent_wine  border hover:text-main" type="button" id="no_modal">Retourner</a>
      <button class="cursor-pointer py-2 px-6 font-medium tracking-wide text-main transition-colors duration-200 rounded border bg-accent_wine hover:border-accent_wine hover:bg-transparent hover:text-accent_wine  focus:outline-none" type="submit">Modifier</button>
    </div>
  </form>
</div>
<!-- bouton d'ajout de bouteille -->
<div class="add_btn fixed right-5 btn-bouteille z-50">
  <a href="{{ route('bouteille.create') }}">
    <div class="shadow-md h-16 w-16 rounded-full transition-colors duration-200 flex justify-center cursor-pointer p-2.5 bg-accent_wine_light hover:bg-accent_wine text-main"><img class="absolute left-6 h-11 self-center" src="{{asset('img/svg/bouteille-plus.svg')}}" alt="add-button"></div>
  </a>
</div>
@endsection