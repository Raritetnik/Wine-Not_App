@extends('layouts.app')
@section('content')
<section class="px-6">
    @foreach ($bouteilles as $bouteille)
    <!-- carte -->
    <div class="mb-2">
        <v-bouteille :bouteille="{{ $bouteille }}" :liste="{{ $liste }}"/>
    </div>
    @endforeach
</section>
@endsection