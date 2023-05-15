@extends('layouts.app')
@section('content')
<section class="px-6">
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
            <h1>Aucune bouteille dans la liste de favoris</h1>
        </div>
    @endif
    @foreach ($bouteilles as $bouteille)
    <!-- carte -->
    <div class="mb-2 flex flex-col items-center">
        <v-bouteille-fav :bouteille="{{ $bouteille }}"/>
    </div>
    @endforeach
</section>
@endsection