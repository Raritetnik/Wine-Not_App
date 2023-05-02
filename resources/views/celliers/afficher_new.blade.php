<div class="conteneur-de-toute-la-page">
    <!-- Bouton pour filtrer carte -->
    <div class="filtrer-cartes">
        <label>
            <div class="bouton-filtre">Filtrer</div>
            <input type="checkbox" name="filtre" class="checkbox-filtre">
        </label>
    </div>
<div class="container mx-auto py-8 px-8 sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
<!-- Redirection vers modifier les infos du cellier -->
<div class="pb-6 text-center w-full">
<h3 class="mb-2 text-3xl font-bold leading-none sm:text-2xl">
  {{$cellier->nom}}
</h3>
</div>
<div class="pb-6 text-center w-full">
    <a href="{{route('celliers.modifier', $cellier->id)}}" class="inline-flex items-center justify-center space-x-2 bg-accent_wine hover:accent_wine-80 text-main font-bold ml-2 py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <div><span class="ml-2 py-8"></span>Modifier cellier</div>
    </a>
  </div>
  @endsection