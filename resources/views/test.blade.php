@extends('layouts.app')
@section('content')

<main class="py-4">
<div class="px-4 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
  <div class="container mx-auto">
    <header class="mb-8">
      <a href="/" class="text-accent_wine uppercase tracking-wide font-bold">
        <img src="{{ asset('img/svg/logoWn.svg') }}" alt="logo-wineNot" class="mx-auto" width="120">
      </a>
    </header>
    
    @extends('layouts.app')
    @section('content')
    
    <main class="py-4">
    <div class="px-4 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
      <div class="container mx-auto">
        <header class="mb-8">
          <a href="/" class="text-accent_wine uppercase tracking-wide font-bold">
            <img src="{{ asset('img/svg/logoWn.svg') }}" alt="logo-wineNot" class="mx-auto" width="120">
          </a>
        </header>
        <section class="mx-4 px-6 flex flex-col mb-4">
          <div class="flex flex-col space-y-4 md:flex-row md:space-x-6 md:space-y-0">
            
          <div class="w-full md:w-1/2 mb-3">
            <div class="flex items-center justify-between mb-3">
             
          </div>
              <label for="quantite" class="block text-gray-700 font-bold mb-2">Date d'ajout</label>
              <input type="date" class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none" name="date_achat" id="date_achat">  
                  <span class="text-m font-medium text-section_title leading-snug">
                    {{$bouteille ?? ''->date_achat ?? ''}}
                  </span>
              </input>
          </div>
        </div>
        <div class="mb-2">
          <h5 class="sm:text-2xl text-article_title text-xl font-bold leading-6 mb-4">{{$bouteille ?? '' -> nom}}</h5>
          <label for="date_achat" class="block text-gray-700 font-bold mb-2">Date d'achat</label>
          <div class="flex flex-col md:flex-row md:space-x-4">
            <input
              type="date_achat"
              name="date_achat"
              id="date_achat"
              placeholder="Date d'achat"
              class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none mb-2 md:mb-0 md:w-2/5 mb-3"
            />
          </div>
            <label for="garde_jusqua" class="block text-gray-700 font-bold mb-2">Gardez jusqu'à</label>
            <div class="flex flex-col md:flex-row md:space-x-4">
              <input
              type="date"
              name="garde_jusqua"
              id="garde_jusqua"
              placeholder="Gardez jusqu'à"
              class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none mb-2 md:mb-0 md:w-3/5"
            />
            </div>
        </div>
        <div class="w-full md:w-1/2 mb-3">
          <label class="block text-gray-700 font-bold mb-2">Cellier</label>
          <select class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none" name="cellier" id="cellier">
            <option value="celliers.id.nom">cellier 1</option>
            <option value="">cellier 2</option>
            <option value="">cellier 3</option>
          </select>
      </div>
      </section>
      <footer class="flex flex-col items-center mb-8 mx-10">
        <a href="/register" class="text-white py-2 w-full rounded-md mb-2 flex justify-center" style="background-color: #67375C">Ajouter</a>
        <small style="color: #909090">
          <a href="/login" style="color: #67375C">Previous</a>
        </small>
      </footer>
      </div>
      </div>
    </main>
    </div>
      @endsection

  <footer class="flex flex-col items-center mb-8 mx-10">
    <a href="/register" class="text-white py-2 w-full rounded-md mb-2 flex justify-center" style="background-color: #67375C">Ajouter</a>
    <small style="color: #909090">
      <a href="/login" style="color: #67375C">Previous</a>
    </small>
  </footer>
  </div>
  </div>
</main>
</div>
  @endsection