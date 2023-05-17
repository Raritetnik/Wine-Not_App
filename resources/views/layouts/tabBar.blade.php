
<div class="tab-bar text-white text-sm px-2">
  @guest
  <a href="{{ route('login') }}" class="tab-icon">
    @guest
    <img src="{{ asset('img/svg/log-in.svg') }}" alt="menu" class="inline-block align-middle pb-2">
    <span class="inline-block align-middle">Log In</span>
  </a>
  @endguest
  @else
    @endguest
  @guest
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
      <div class="more-options">
        <a href="/mes-celliers" class="tab-icon">
          <span class="inline-block align-middle">Mes Celliers</span>
        </a>
        <a href="/inscription" class="tab-icon">
          <span class="inline-block align-middle">Inscription</span>
        </a>
        <a href="/ajouter-bouteille" class="tab-icon">
          <span class="inline-block align-middle">Ajouter Bouteille</span>
        </a>
        <a href="/tutoriel" class="tab-icon">
          <span class="inline-block align-middle">Tutoriel</span>
        </a>
      </div>
    </div>
  @endguest
</div>
</div>

