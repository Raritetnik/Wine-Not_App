<section id="form-personal" class="hidden self-center px-6 flex-col w-full lg:w-2/5">

  <!-- action="{{ route('bouteille.inserer') }}" -->
  <form method="post" enctype="multipart/form-data" class="w-full pt-3">
    <!-- ajouter un token pour autoriser la route une seconde fois -->
    @csrf

    <h2 class="text-accent_wine text-xl font-extrabold pb-6">
      Bouteille personnelle
    </h2>
    <div class="w-full mb-5">
      <label for="nom" class="text-section_title text-sm font-bold mb-3">Ajouter une bouteille</label>
      <input type="nom" name="nom" id="nom" placeholder="Nom de la bouteille" class="block w-full py-3 px-3 rounded-md border border-gray-300 focus:border-secondary focus:outline-none placeholder-section_title {{ $errors->has('nom') ? 'border-error' : '' }}" value="{{ old('nom') }}" required />
    </div>


    <div class="w-full mb-5">
      <label for="img" class="text-section_title text-sm font-bold mb-3">Ajouter une image</label>
      <div class="relative w-full py-3 px-3 rounded-md border border-gray-300 focus:border-secondary focus:outline-none">
        <input id="img" type="file" class="opacity-0 absolute z-50 w-full py-3 px-3 border border-gray-400 rounded-lg cursor-pointer" name="image">
        <div class="flex justify-between gap-3  sm:text-md cursor-pointer">
          <span class="text-section_title" id="file-name">Choisir une image</span><img id="imgForm" src="{{ asset('img/svg/addPhoto.svg') }}" alt="add-image">
        </div>
      </div>
    </div>
    <div class="w-full sm:w-1/2 mb-3">
           <label for="millesime" class="text-section_title text-sm font-bold mb-3">Millésime</label>
           <input class="w-full py-3 px-3 placeholder-section_title rounded-md border border-gray-300 focus:border-secondary focus:outline-none appearance-none" name="annee" id="millesime" min="1" placeholder="Entrer l'année du vin">
           </input>
         </div>

    <div class="mb-2 flex flex-wrap md:flex-nowrap gap-3">
      <div class="w-full mb-3">
        <label for="date_achat" class="text-section_title text-sm font-bold mb-3">Date d'achat</label>
        <div class="flex flex-col md:flex-row md:space-x-4">
          <input type="date" name="date_achat" id="date_achat" placeholder="Date d'achat" class="w-full placeholder-section_title py-3 px-3 rounded-md border border-gray-300 focus:border-secondary focus:outline-none" />
        </div>
      </div>
      <div class="w-full mb-3">
        <label for="date_exp" class="text-section_title text-sm font-bold mb-3">Valide jusqu'à</label>
        <div class="flex flex-col md:flex-row md:space-x-4">
          <input type="date" name="garde_jusqua" id="date_exp" placeholder="Valide jusqu'à" class="w-full py-3 px-3 rounded-md border border-gray-300 placeholder-section_title focus:border-secondary focus:outline-none" />
        </div>
      </div>
    </div>
    <div class="mb-2 flex justify-between gap-3">
      <div class="w-1/2 mb-3">
        <label for="qty" class="text-section_title text-sm font-bold mb-3">Quantité<b class="text-accent_wine"> *</b></label>
        <input class="w-full py-3 px-3 placeholder-section_title rounded-md border border-gray-300 focus:border-secondary focus:outline-none appearance-none {{ $errors->has('qty') ? 'border-error' : '' }}" name="qty" id="qty" min="1" placeholder="Quantité" value="{{ old('qty') }}" required>
        </input>

        <!-- {{ $errors->has('qty') ? 'border-error' : '' }} -->
      </div>
      <div class="w-1/2 mb-3">
        <label for="prix" class="text-section_title text-sm font-bold mb-3">$ Prix</label>
        <input class="w-full py-3 px-3 placeholder-section_title rounded-md border border-gray-300 focus:border-secondary focus:outline-none appearance-none" name="prix_saq" id="prix" min="1" placeholder="Prix par bouteille">
        </input>
      </div>
    </div>
    <div class="mb-2 flex justify-between gap-3">
      <div class="w-1/2 mb-3">

        <label for="cellier" class="text-section_title text-sm font-bold mb-3">Celliers</label>
        <select name="vino_cellier_id" id="cellier" class="w-full block py-3 px-3 bg-transparent bg-gray-50  rounded-md border border-gray-300 focus:border-secondary focus:outline-none">
          @foreach($celliers as $index => $cellier)
          @if($index === 0) <!-- verifier si index 0, 1er element du array -->
          <option value="{{$cellier->id}}" selected>{{$cellier->nom}}</option>
          @else
          <option value="{{$cellier->id}}">{{$cellier->nom}}</option>
          @endif
          @endforeach
        </select>

      </div>
      <div class="w-1/2 mb-3">

        <label for="pays" class="text-section_title text-sm font-bold mb-3">Pays Producteur</label>
        <select name="pays_id" id="pays" class="w-full text-section_title block py-3 px-3 rounded-md border bg-transparent bg-gray-50 border-gray-300 focus:border-secondary focus:outline-none">
          <option class="text-section_title" value="">Pays</option>
          @foreach($pays as $place)
          <option value="{{$place->id}}">{{ $place->pays }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="flex justify-between gap-3">
      <div class="w-1/2 mb-3">

        <label for="type" class="text-section_title text-sm font-bold mb-3">Type de Vin</label>
        <select name="vino_type_id" id="type" class="w-full text-section_title block py-3 px-3 rounded-md bg-transparent bg-gray-50 border border-gray-300 focus:border-secondary focus:outline-none">
          <option class="text-section_title" value="">Type</option>
          @foreach($types as $type)
          <option value="{{$type->id}}">{{ $type->type }}</option>
          @endforeach
        </select>
      </div>
      <div class="w-1/2  mb-3">

        <label for="format" class="text-section_title text-sm font-bold mb-3">Volume</label>
        <select name="vino_format_id" id="format" class="w-full text-section_title block py-3 px-3  bg-transparent bg-gray-50 rounded-md border border-gray-300 focus:border-secondary focus:outline-none">
          <option class="text-section_title" value="">Format</option>
          @foreach($formats as $format)
          <option value="{{$format->id}}">{{ $format->format }}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="mt-7 flex">
      <button type="submit" class="w-1/2 px-7 py-1.5 rounded-md bg-accent_wine text-lg font-medium text-main hover:bg-transparent border hover:border-accent_wine hover:text-accent_wine transition-colors duration-200 ease-in-out">Ajouter</button>
    </div>



  </form>
</section>