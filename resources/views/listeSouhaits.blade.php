@extends('layouts.app')
@section('content')
<section class="px-6">
    <div class="pb-6 text-center w-full">
        <h2 class="mb-2 text-accent_wine text-2xl font-bold leading-none sm:text-3xl">Liste des souhaits</h2>
    </div>
    @if(empty($bouteilles))
        <div class="flex justify-center">
            <h1>Aucune bouteille dans la liste de favoris</h1>
        </div>
    @endif
    @foreach ($bouteilles as $bouteille)
    <!-- carte -->
    <div class="mb-2 flex flex-col items-center">
        <v-bouteille-fav :bouteille="{{ $bouteille }}" :liste="{{ $liste }}"/>
    </div>
    @endforeach
</section>
@endsection