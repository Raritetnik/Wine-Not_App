@extends('layouts.app')

@section('content')

<div class="flex justify-center mb-7 mt-5">
  <section class="px-6 flex flex-col w-full lg:w-2/5">
    <header class="mb-8 md:hidden">
      <a href="/" class="text-accent_wine uppercase tracking-wide font-bold">
        <img src="{{ asset('img/svg/logoWn.svg') }}" alt="logo-wineNot" class="mx-auto" width="120">
      </a>
    </header>

    <form method="post" enctype="multipart/form-data">
    <form method="post" action="{{ route('bouteille.update', ['bouteille' => $bouteille->id]) }}" enctype="multipart/form-data" class="w-full">
      <!-- ajouter un token pour autoriser la route une seconde fois -->
      @csrf
      @method('PUT')

      <div class="w-full mb-5">
        <label for="nom" class="block text-section_title font-bold mb-2">Nom de la bouteille</label>
        <input type="text" name="nom" id="nom" value="{{ $bouteille->nom }}" class="block w-full py-3 px-3 rounded-md border border-gray-300 focus:border-secondary focus:outline-none placeholder-section_title" />
      </div>

      <div class="w-full mb-5">
        <label for="img" class="block text-section_title font-bold mb-2">Image</label>
        <div class="block relative w-full py-3 px-3 rounded-md border border-gray-300 focus:border-secondary focus:outline-none">
          <input id="img" type="file" class="opacity-0 absolute z-50 w-full py-3 px-3 border border-gray-400 rounded-lg cursor-pointer" name="image">
          <div class="flex justify-between gap-3  sm:text-md cursor-pointer">
            <span class="block text-section_title" id="file-name">Choisir une image</span><img src="{{ asset('img/svg/addPhoto.svg') }}" alt="add-image">
          </div>
        </div>
      </div>

      <div class="mb-2 flex flex-wrap md:flex-nowrap gap-3">
        <div class="w-full mb-3">
          <label for="date_achat" class="block text-section_title font-bold mb-2">Date d'achat</label>
          <div class="flex flex-col md:flex-row md:space-x-4">
            <input type="date" name="date_achat" id="date_achat" value="{{ $bouteille->date_achat }}" placeholder="Date d'achat" class="block w-full placeholder-section_title py-3 px-3 rounded-md border border-gray-300 focus:border-secondary focus:outline-none" />
          </div>
        </div>
        <div class="w-full mb-3">
          <label for="date_exp" class="block text-section_title font-bold mb-2">Valide jusqu'à</label>
          <div class="flex flex-col md:flex-row md:space-x-4">
            <input type="date" name="garde_jusqua" id="date_exp" value="{{ $bouteille->garde_jusqua }}" placeholder="Valide jusqu'à" class="block w-full py-3 px-3 rounded-md border border-gray-300 placeholder-section_title focus:border-secondary focus:outline-none" />
          </div>
        </div>
      </div>
      <div class="mb
