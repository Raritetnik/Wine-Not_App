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
    <section class="mx-4 px-6 flex flex-col mb-2">
      <div class="flex flex-col space-y-4 md:flex-row md:space-x-6 md:space-y-0">
        <div class="">
          <label for="recherche" class="text-m font-medium text-section_title leading-snug">Recherche</label>
      <div class="w-full md:w-1/2 mb-3">
          <input type="text" placeholder="Recherche" class="inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-accent_wine transition duration-200 rounded shadow-md border border-accent_wine focus:shadow-outline focus:outline-none">
      </div>
          <label for="quantite" class="block text-gray-700 font-bold mb-2">Quantité</label>
          <input class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none" name="quantité" id="quantité" placeholder="Quantité">
          </input>
      </div>
    </div>
    <div class="mb-2">
      <label for="date_achat" class="block text-gray-700 font-bold mb-2">Date d'achat</label>
      <div class="flex flex-col md:flex-row md:space-x-4">
        <input
          type="date"
          name="date_achat"
          id="date_achat"
          placeholder="Date d'achat"
          class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none mb-2 md:mb-0 md:w-2/5 mb-3"
        />
      </div>
      <label class="block text-gray-700 font-bold mb-2">Date d'ajout</label>
      <div class="w-full md:w-1/2 mb-3">
        <div class="flex flex-col md:flex-row md:space-x-4">
        <input
        type="date"
        name="gardez_jusqua"
        id="gardez_jusqua"
        class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none mb-2 md:mb-0 md:w-2/5 mb-3"
      />
  </div>
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