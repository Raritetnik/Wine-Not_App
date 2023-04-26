@extends('layouts.app')
@section('content')
<div class="container">
  <header class="mb-8">
    <a href="/" class="text-accent_wine uppercase tracking-wide font-bold">
      <img src="{{ asset('img/svg/logoWn.svg') }}" alt="logo-wineNot" class="mx-auto" width="120">
    </a>
  </header>
  <section class="mx-4 px-6 flex flex-col mb-4">
    <div class="flex flex-col space-y-4 md:flex-row md:space-x-6 md:space-y-0">
      <div class="formbold-main-wrapper">
          <div class="formbold-form-wrapper">
          <form action="{{route('celliers.insererCellier')}}" method="post" enctype="multipart/form-data" class="w-full">
               <!-- ajouter un token pour autoriser la route une seconde fois -->
               @csrf
      <div class="w-full md:w-1/2 mb-3">
          <label for="email" class="block text-gray-700 font-bold mb-2">Ajoutez une bouteille</label>
          <input
          type="nom"
          name="nom"
          id="nom"
          placeholder="nom de la bouteille"
          class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none"
          />
      </div>
      <div class="w-full md:w-1/2 mb-3">
          <label class="block text-gray-700 font-bold mb-2">Quantité</label>
          <input class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none" name="quantité" id="quantité" placeholder="Quantité">
          </input>
      </div>
    </div>
  
    <div class="mb-6">
      <label for="phone" class="block text-gray-700 font-bold mb-2">Date d'achat</label>
      <div class="flex flex-col md:flex-row md:space-x-4">
        <input
          type="date"
          name="date"
          id="date"
          placeholder="Date d'achat"
          class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none mb-2 md:mb-0 md:w-2/5 mb-3"
        />
        <label for="phone" class="block text-gray-700 font-bold mb-2">Valide jusqu'à</label>
        <input
          type="date"
          name="date_achat"
          id="date_achat"
          placeholder="Valide jusqu'à"
          class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none mb-2 md:mb-0 md:w-3/5"
        />
          
  </section>
  <footer class="flex flex-col items-center mb-8 mx-10">
    <a href="/register" class="text-white py-2 w-full rounded-md mb-2 flex justify-center" style="background-color: #67375C">Commencer</a>
    <small style="color: #909090">
      Avez-vous déjà un compte?
      <a href="/login" style="color: #67375C">Connecter</a>
    </small>
  </footer>
</div>
@endsection