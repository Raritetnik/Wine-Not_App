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
      <h3 class="mt-5" style="color: var(--color_text)">Information personelle</h1>
      <blockquote class="mb-5 mt-2 border-accent_wine border rounded">
        <v-profile :user="{{ $utilisateur }}"/>
      </blockquote>
      <div class=" mb-5">
        <form method="POST" action="{{ route('compte.update') }}">
          @csrf
          <div class="mb-4">
            <label for="old-password" style="color: var(--color_text)">Mot de passe précedant</label>
            <input id="old-password" type="password" placeholder="Ancien mot de passe" class="appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine @error('password') border-red-500 @enderror" name="old-password" required autocomplete="new-password">
            @error('password')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-2">
            <label for="password" style="color: var(--color_text)">Nouveau mot de passe</label>
            <input id="password" type="password" placeholder="Nouveau mot de passe" class="appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
            @error('password')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
          </div>
          <div class="mb-5">
            <input id="password-confirm" type="password" placeholder="Confirmer votre mot de passe" class="appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine" name="password_confirmation" required autocomplete="new-password">
          </div>
          <footer class="flex flex-col items-center mb-10">
            <button type="submit" class="text-white py-2 mt-4 w-full rounded-md mb-2" style="background-color: #67375C">Modifier</button>
          </footer>
        </form>
      </div>
    </div>
  </div>
@endsection