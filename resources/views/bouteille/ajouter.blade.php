@extends('layouts.app')
@section('content')
<div>
    <!-- Form d'ajout de bouteilles dans ce cellier-->
    <form method="post" enctype="multipart/form-data">
    <!-- passer la méthode PUT et aussi le token expired réémission du token-->
     @csrf
      @method('PUT')
    <div class="w-full">
        <h2 class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nom">
          Ajouter une bouteille
        </h2>
      </div>
      <section class="flex flex-wrap border-b-2 pb-6 border-accent_wine">
        <div class="w-1/2 flex">
          <v-recherche />
        </div>
        <div class="w-1/2 flex flex-col">
          <label>
            <input id="quantite" name="quantite" class="w-full appearance-none bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="Quantité de bouteilles à ajouter">
          </label>
          <label>
            <input id="date_achat" name="date_achat" class="w-full appearance-none bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="date" placeholder="Garde jusqu'à quand">
          </label>
          <label>
            <input id="garde_jusqua" name="garde_jusqua" class="w-full appearance-none bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="date" placeholder="Garde jusqu'à quand">
          </label>
          <label>
            <input id="millesime" name="millesime" class="w-full appearance-none bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" placeholder="Millésime">
          </label>
          <label>
            <input class="inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-accent_wine transition duration-200 rounded shadow-md border border-accent_wine hover:bg-accent_wine hover:text-main focus:shadow-outline focus:outline-none" type="submit" value="Ajouter au cellier">
          </label>
        </div>
    </form>
  </div>
  @endsection