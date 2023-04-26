@extends('layouts.app')
@section('content')
<div class="container">
  <header class="mb-8">
    <a href="/" class="text-accent_wine uppercase tracking-wide font-bold">
      <img src="{{ asset('img/svg/logoWn.svg') }}" alt="logo-wineNot" class="mx-auto" width="120">
    </a>
  </header>
  <section class="mx-4 px-6 flex flex-col gap-6 mb-8">
    <div class="flex flex-col space-y-4 md:flex-row md:space-x-4 md:space-y-0">
      <div class="w-full md:w-1/2">
          <label for="email" class="block text-gray-700 font-bold mb-2">AJOUTER UNE BOUTEILLE</label>
          <input
          type="email"
          name="email"
          id="email"
          placeholder="example@email.com"
          class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none"
          />
      </div>
      <div class="w-full md:w-1/2">
          <label class="block text-gray-700 font-bold mb-2">Gender</label>
          <select class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none" name="occupation" id="occupation">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="others">Others</option>
          </select>
      </div>
    </div>
  
    <div class="mb-6">
      <label for="phone" class="block text-gray-700 font-bold mb-2">Phone</label>
      <div class="flex flex-col md:flex-row md:space-x-4">
        <input
          type="text"
          name="areacode"
          id="areacode"
          placeholder="Area code"
          class="block w-full py-2 px-3 rounded-md border border-gray-300 focus:border-purple-500 focus:outline-none mb-2 md:mb-0 md:w-2/5"
        />
        <input
          type="text"
          name="phone"
          id="phone"
          placeholder="Numero de téléphone"
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