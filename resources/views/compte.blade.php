@extends('layouts.app')

@section('content')
  <div class="min-h-[500px] flex justify-center items-center w-full">
    <div class="bg-white rounded-lg overflow-hidden max-w-[400px] w-full">
      <header class="flex flex-col justify-center logo w-[400px]">
        <h1 class="font-bold text-2xl pb-6" style="color: var(--color_champ)">Mon Profile</h1>
        <h3 class="pb-2" style="color: var(--color_text)">Inventaire</h3>
        <blockquote class="flex p-4 justify-around bg-gray-200">
          <div class="flex flex-col items-center" style="color: var(--color_champ)">
            <h3>Quantités Total</h3>
            <p class="flex items-center" style="height: 30px;">{{ $userInfo['quantiteBouteilles'] }}
              <img class="ps-2" src="{{ asset('/img/svg/empty_bottle.svg') }}" style="height: 30px;" alt="">
            </p>
          </div>
          <div class="flex flex-col items-center" style="color: var(--color_champ)">
            <h3>Valeur Total</h3>
            <p class="flex items-center" style="height: 30px;">$CAD {{ $userInfo['prixBouteilles'] }}</p>
          </div>
        </blockquote>
      </header>
      <div class=" mb-5">
        <form method="POST" action="{{ route('compte.update') }}">
          @csrf
          @if (session()->has('success'))
          <div class="bg-green-300 border-green-600 rounded mt-4 mx-6 p-4" style="color: var(--color_text)">
            {{ session()->get('success') }}
          </div>
          @endif
          <div>
            <v-profile :user="{{ $utilisateur }}"/>
          </div>
          @error('oldPassword')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
          @enderror
          <footer class="flex flex-col items-center mb-10 mt-5">
            <button type="submit" class="text-white py-2 mt-4 w-full rounded-md mb-2" style="background-color: #67375C">Modifier</button>
            <v-supprimer-compte :user="{{ $utilisateur }}"/>
          </footer>
        </form>
      </div>
    </div>
  </div>
@endsection