@extends('layouts.app')
@section('content')
<section class="container px-6">
    @foreach ($bouteilles as $bouteille)
    <!-- carte -->
    <div class="mb-2">
        <v-bouteille :bouteille="{{ $bouteille }}"/>
    </div>
    @endforeach
</section>
@endsection