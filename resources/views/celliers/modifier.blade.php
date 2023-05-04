@extends('layouts.app')
@section('content')
<div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <div class="pb-6 text-center w-full">
      <h2 class="mb-2 text-3xl font-bold leading-none sm:text-4xl">
        Modifier Mon Cellier
      </h2>
    </div>
    <div class="pb-6 text-center w-full">
      <p class="text-gray-700 mb-4">Veuillez remplir le formulaire suivant pour modifier un cellier</p>
    </div>
    <form method="post" enctype="multipart/form-data">
      <!-- ajouter un token pour autoriser la route une seconde fois -->
      <!-- méthode put pour modification -->
      @csrf
      @method('PUT')
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="nom">
          Nom
        </label>
        <!-- ** important de concerver les input ** -->
        <input value="{{$cellier->nom}}" class="w-full items-center justify-center h-12 px-6 font-medium tracking-wide text-accent_wine transition duration-200 rounded border border-accent_wine focus:shadow-outline" id="nom" name="nom" type="text" placeholder="Entrez le nom du cellier" required>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="quantite_max">
          Quantité
        </label>
        <input value="{{$cellier->quantite_max}}" class="w-full items-center justify-center h-12 px-6 font-medium tracking-wide text-accent_wine transition duration-200 rounded border border-accent_wine focus:shadow-outline" id="quantite_max" name="quantite_max" type="number" placeholder="Capacité maximale du cellier">
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="description">
          Description
        </label>
        <textarea class="w-full h-full items-center justify-center h-12 px-6 font-medium tracking-wide text-accent_wine transition duration-200 rounded border border-accent_wine focus:shadow-outline" id="description" name="description" type="text" placeholder="Ajouter un descriptif pour ce cellier">{{$cellier->description}}</textarea>
      </div>
      <div class="mb-4 py-4 text-center">
        <input value = "Modifier" class="bg-accent_wine hover:accent_wine-80 text-main font-bold py-2 px-8 rounded focus:outline-none focus:shadow-outline" type="submit" placeholder="Créer le cellier">
        </input>
      </div>
    </form>
  </div>
</div>
</div>

<!-- <div class="w-full px-3">
      <input class="inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide text-accent_wine transition duration-200 rounded shadow-md border border-accent_wine hover:bg-accent_wine hover:text-main focus:shadow-outline focus:outline-none" 
      type="submit" 
      placeholder="Créer le cellier">
    </div> -->
</div>
</form>
</div>
@endsection