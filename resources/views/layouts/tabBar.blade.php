
<div class="tab-bar text-white text-sm px-2">
  @guest
    <a href="{{ route('login') }}" class="tab-icon">
      <img src="{{ asset('img/svg/log-in.svg') }}" alt="menu" class="inline-block align-middle pb-2">
      <span class="inline-block align-middle">Connexion</span>
    </a>
    <a href="{{ route('register') }}" class="tab-icon">
      <img src="{{ asset('img/svg/user2.svg') }}" alt="menu" class="inline-block align-middle pb-2">
      <span class="inline-block align-middle">Créer compte</span>
    </a>
  @else
    <!-- User Menu -->
    <a href="/favoris" class="tab-icon">
      <img src="{{ asset('img/svg/heart.svg') }}" alt="menu" class="inline-block align-middle pb-2">
      <span class="inline-block align-middle">Favoris</span>
    </a>
    <a href="{{route('celliers.index') }}" class="tab-icon">
      <img src="{{ asset('img/svg/celliers3.svg') }}" alt="menu" class="inline-block align-middle pb-2" aria-label="Celliers" title="Celliers">
      <span class="inline-block align-middle">Mes Celliers</span>
    </a>
    <a href="/compte" class="tab-icon transition-colors duration-200 hover:text-secondary" aria-label="Compte" title="Compte">
      <img src="{{ asset('img/svg/user2.svg') }}" class="inline-block align-middle pb-2">
      <span class="inline-block align-middle">Profil</span>
    </a>
    <div class="more-menu px-6">
      <a href="#" id="mobile-menu-button" class="more-label">
          <img src="{{ asset('img/svg/more2.svg') }}" alt="menu" class="inline-block align-middle pt-1 pb-1">
          <span class="inline-block align-middle">Plus</span>
      </a>
    </div>
  @endguest
</div>
</div>

