@extends('layouts.app')

@section('content')

<!-- <header class="logo">
    <a href="/" class="text-accent_wine uppercase tracking-wide font-bold pb-6">
      <img src="{{ asset('img/svg/logoWn.svg') }}" alt="logo-wineNot" class="mx-auto" width="120">
    </a>
  </header> -->

<div class="min-h-[500px] container flex justify-center items-center mx-auto">
  <div class="bg-white rounded-lg overflow-hidden max-w-[400px] w-full">

    <div id="Header" class="flex flex-col items-center my-10">
      <h2 class="text-center text-accent_wine text-3xl">Créer un compte</h2>
      <small style="color: var(--color_text)">Commencer aujourd'hui</small>
    </div>
    <div class="px-6 mb-5">
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="flex gap-2 mb-4">
          <div>
            <label for="firstName" style="color: var(--color_text)">Prénom</label>
            <input id="firstName" type="text" placeholder="{{ __('Prenom') }}" class="appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine @error('firstName') border-red-500 @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>
            @error('firstName')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
          </div>
          <div>
            <label for="lastName" style="color: var(--color_text)">Nom</label>
            <input id="lastName" type="text" placeholder="{{ __('Nom') }}" class="appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine @error('lastName') border-red-500 @enderror" name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>
            @error('lastName')
            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="mb-4">
          <label for="courriel" style="color: var(--color_text)">Courriel</label>
          <input id="courriel" type="email" placeholder="Entrez votre courriel" class="appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine @error('courriel') border-red-500 @enderror" name="courriel" value="{{ old('courriel') }}" required autocomplete="courriel">
          @error('courriel')
          <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-4">
          <label for="password" style="color: var(--color_text)">Mot de passe</label>
          <input id="password" type="password" placeholder="Entrez votre mot de passe" class="appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
          @error('password')
          <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-5">
          <label for="password" style="color: var(--color_text)">Confirmation de mot de passe</label>
          <input id="password-confirm" type="password" placeholder="Resaisir votre mot de passe" class="appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine" name="password_confirmation" required autocomplete="new-password">
        </div>
        <footer class="flex flex-col items-center mb-10">
          <button type="submit" class="text-white py-2 w-full rounded-md mb-2 bg-accent_wine hover:opacity-95">Inscription</button>
          <span class="text-section_title font-normal text-sm pt-2">
            Avez-vous déjà un compte?
            <a href="/register" class="text-accent_wine hover:text-section_title">Connecter</a>
          </span>
        </footer>
      </form>
    </div>
  </div>
</div>
</div>



@endsection