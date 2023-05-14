@extends('layouts.app')
@section('content')

<!-- <div class=""> -->
<!-- <header class="logo">
    <a href="/" class="text-accent_wine uppercase tracking-wide font-bold pb-6">
      <img src="{{ asset('img/svg/logoWn.svg') }}" alt="logo-wineNot" class="mx-auto" width="120">
    </a>
  </header> -->

<div class="min-h-[500px] container flex justify-center items-center mx-auto">
  <div class="bg-white rounded-lg overflow-hidden max-w-[400px] w-full">

    <div id="Header" class="flex flex-col items-center my-10">
      <h2 class="text-center text-accent_wine text-3xl">De Retour!</h2>
      <span class="text-section_title font-medium text-sm">Entrez dans votre compte</span>
    </div>
    <div class="px-6 mb-5">
      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
          <label for="courriel" style="color: var(--color_text)">Courriel</label>
          <input id="courriel" type="email" placeholder="Entrez votre courriel" class="appearance-none placeholder-section_title border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine @error('courriel') border-red-500 @enderror" name="courriel" value="{{ old('courriel') }}" required autocomplete="courriel" autofocus>
          @error('courriel')
          <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-4">
          <label for="password" style="color: var(--color_text)">Mot de passe</label>
          <input id="password" type="password" placeholder="Entrez votre mot de passe" class="placeholder-section_title  appearance-none border rounded w-full py-3 px-3 text-accent_wine leading-tight focus:outline-none border-accent_wine @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
          @error('password')
          <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
          @enderror
        </div>
        <div class="mb-4 flex justify-between items-center">
          
          <div>
            <input type="checkbox" class="form-checkbox h-4 w-4 text-section_title" name="remember" id="remember" {{ session('remember') ? 'checked' : '' }}>
            <label class="ml-2 text-section_title text-sm hover:text-accent_wine" for="remember">
              {{ __('Se souvenir de moi') }}
            </label>
          </div>

          @if (Route::has('password.request'))
          <a class="ml-5 inline-block align-baseline text-sm text-accent_wine hover:text-section_title " href="{{ route('password.request') }}">
            {{ __('Le mot de passe oublié?') }}
          </a>
          @endif
        </div>
        <footer class="flex flex-col items-center mb-10">
          <button type="submit" class="text-white py-2 w-full rounded-md mb-2 bg-accent_wine hover:opacity-95">Continuer</button>
          <div class="w-full flex justify-between items-center">
            <a href="{{ route('home') }}" class="font-bold text-sm  text-accent_wine hover:text-section_title">Tutoriel</a>
            <span class="text-section_title font-medium text-sm">
              Nouveau ici?
              <a href="/register" class="text-accent_wine hover:text-section_title font-bold">Créer un compte</a>
            </span>
          </div>

        </footer>
      </form>
    </div>
  </div>
</div>
<!-- </div> -->
@endsection