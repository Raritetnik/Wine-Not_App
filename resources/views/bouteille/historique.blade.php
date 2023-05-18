@extends('layouts.app')
@section('content')
<section class="px-6">
    <div class="pb-6 text-center w-full">
        <h2 class="mb-2 text-accent_wine text-2xl font-bold leading-none sm:text-3xl">Historique</h2>
    </div>
    <form action="{{ route('historique.supprimer') }}" method="post" class="m-4 flex justify-center items-center">
        @csrf
        <button type="submit"
            class="inline-flex items-center justify-center min-w-max h-12 px-6 font-medium tracking-wide text-accent_wine transition duration-200 rounded shadow-md border border-accent_wine hover:bg-accent_wine hover:text-main focus:shadow-outline focus:outline-none"
          >
            Effacer l'historique
        </button>
    </form>
    @if(empty($bouteilles))
        <div class="flex justify-center">
            <h1>Aucune bouteille dans l'historique</h1>
        </div>
    @endif
    @foreach ($bouteilles as $bouteille)
    <!-- carte -->
    <div class="mb-2 flex flex-col items-center">
        <v-bouteille-fav :bouteille="{{ $bouteille }}"/>
    </div>
    @endforeach
</section>
  <!-- bouton d'ajout de bouteille -->
  <div class="add_btn fixed right-5 btn-bouteille z-50">
    <a href="{{ route('bouteille.create') }}">
        <div class="shadow-md h-16 w-16 rounded-full transition-colors duration-200 flex justify-center cursor-pointer p-2.5 bg-accent_wine_light hover:bg-accent_wine text-main"><img class="absolute left-6 h-11 self-center" src="{{asset('img/svg/bouteille-plus.svg')}}" alt="add-button"></div>
    </a>
  </div>
@endsection