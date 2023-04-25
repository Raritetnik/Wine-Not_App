@extends('layouts.app')
@section('content')
<ul>
    @foreach ($bouteilles as $bouteille)
    <li><img src="{{ $bouteille->image }}" class="image-carte-cellier object-cover max-h-[350px] rounded" alt="vine-img" /></li>
    @endforeach
</ul>
@endsection