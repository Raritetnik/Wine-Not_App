<div class="tab-bar bg-accent_wine text-white text-sm px-2">
  <a href="{{ route('login') }}" class="tab-icon">
    <img src="{{ asset('img/svg/log-in.svg') }}" alt="menu" class="inline-block align-middle pb-2">
    <span class="inline-block align-middle">Log In</span>
  </a>
  @guest
  @else
  <div class="tab-bar bg-accent_wine text-white text-sm px-2">
    <a href="{{ route('logout') }}" class="tab-icon">
      <img src="{{ asset('img/svg/log-out.svg') }}" alt="menu" class="inline-block align-middle pb-2">
      <span class="inline-block align-middle">Quitter</span>
    </a>
    @endguest
  @guest
  @else
    <!-- User Menu -->
    <div class="tab-icon more-menu">
      <input type="checkbox" id="more-toggle" class="more-toggle">
      <label for="more-toggle" class="more-label">
        <img src="{{ asset('img/svg/more2.svg') }}" alt="menu" class="inline-block align-middle pt-1 pb-1">
        <span class="inline-block align-middle">More</span>
      </label>
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
  <a href="/favoris" class="tab-icon">
    <img src="{{ asset('img/svg/heart.svg') }}" alt="menu" class="inline-block align-middle pb-2">
    <span class="inline-block align-middle">Favoris</span>
  </a>
  <a href="" class="tab-icon">
    <img src="{{ asset('img/svg/clock2.svg') }}" alt="menu" class="inline-block align-middle pb-2">
    <span class="inline-block align-middle">Historique</span>
  </a>
  <a href="/compte" class="tab-icon transition-colors duration-200 hover:text-secondary" aria-label="Compte" title="Compte">
    <img src="{{ asset('img/svg/user2.svg') }}" class="inline-block align-middle pb-2">
    <span class="inline-block align-middle">Profil</span>
  </a>
  @endguest
</div>
