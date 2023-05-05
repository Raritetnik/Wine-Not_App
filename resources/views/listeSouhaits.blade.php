@extends('layouts.app')
@section('content')
<section class="px-6">
    @if(empty($bouteilles))
        <div class="flex justify-center">
            <h1>Aucune bouteille dans la liste de favoris</h1>
        </div>
    @endif
    @foreach ($bouteilles as $bouteille)
    <!-- carte -->
    <div class="mb-2 flex flex-col items-center">
        <v-bouteille :bouteille="{{ $bouteille }}" :liste="{{ $liste }}"/>
    </div>
    @endforeach
</section>
@endsection