<nav id="main-nav" class="lg:bg-gray-50 lg:shadow-sm md:bg-transparent md:shadow-none py-1 relative">
    <!-- Logo -->
    <div class="absolute left-5 z-0">
        <a href="{{ route('home') }}"><img src="{{ asset('img/svg/logoWn.svg') }}" alt="Logo"></a>
    </div>

    <div class="relative flex h-[70px] items-center justify-end lg:hidden">
        <div class="flex justify-between items-center absolute z-20 right-5 gap-8">
            @guest
            @else
              <!-- Favoris Menu -->
              <div class="z-10 ">
                <a href="/favoris" class="bg-white"><img src="{{ asset('img/svg/favoris.svg') }}" class="bg-white p-1 pt-2 mb-1 rounded" alt="fav_icon" style="min-width: 25px"></a>
              </div>
            @endguest

            <!-- Burger Menu -->
            <!-- hover:text-accent_wine hover:border-accent_wine -->
            <div class="flex items-center">
                <button id="mobile-menu-button" type="button" class="z-50 rounded-md  border-3  focus:outline-none transition-all duration-150 ease-in-out">
                    <svg class="h-10 w-10 hover:opacity-80" stroke="#67375C" fill="none" viewBox="0 0 25 25">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!--

        Mobile Menu

    -->
    <!-- from-accent_wine to-main bg-gradient-to-t -->
    <div id="mobile-menu" class="z-10 pt-10 transition duration-300 hidden lg:hidden bg-accent_wine absolute top-0 left-0 w-full">
      <div class="space-y-7 flex flex-col items-center justify-center pb-10 mt-4">
      <div class="absolute z-50 left-5 top-1">
        <a href="{{ route('home') }}"><img src="{{ asset('img/svg/logoWn-white.svg') }}" alt="Logo"></a>
    </div>
        @guest
        <a href="{{ route('login') }}" class="justify-center tracking-wide font-regular text-xl text-main transition-colors duration-200 hover:text-secondary" aria-label="sign-in" title="sign-in">
          Connexion
        </a>
        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-md py-2.5 px-6 font-regular tracking-wide text-main text-xl transition duration-200 hover:text-secondary" aria-label="sign-up" title="sign-up">
          Inscription
        </a>

        @else
        <!-- font-medium tracking-wide text-accent_wine -->
        <a href="{{ route('celliers.index') }}" class="justify-center font-regular tracking-wide text-xl text-main transition-colors duration-200 hover:text-secondary" aria-label="celliers" title="celliers">
          Mes Celliers
        </a>
        <a href="{{route('celliers.creer')}}" class="justify-center font-regular tracking-wide text-xl text-main transition-colors duration-200 hover:text-secondary" aria-label="articles" title="articles">
          Ajouter Cellier
        </a>
        <a href="{{route('historique')}}" class="justify-center font-regular tracking-wide text-xl text-main transition-colors duration-200 hover:text-secondary" aria-label="articles" title="articles">
          Historique
        </a>
        <a href="{{ route('logout') }}" class="justify-center font-regular tracking-wide text-xl text-main transition-colors duration-200 hover:text-secondary" aria-label="Sign out" title="deconnecter" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Déconnexion
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </a>
        <a href="/compte" class="justify-center font-regular tracking-wide text-xl text-main transition-colors duration-200 hover:text-secondary" aria-label="Compte" title="Compte"><!--<img class="max-w-[37px]" src="{{ asset('img/svg/user-full.svg') }}" alt="user-profile">
          {{ Auth::user()->nom }} -->Mon Compte
        </a>
        @endguest
      </div>
    </div>


    <!---


        Desktop Menu


    -->
    <div class="max-w-8xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="hidden sm:relative sm:flex items-center justify-between h-16">

          <!-- Menu -->
          <div class="hidden sm:flex sm:items-center sm:justify-end w-full">
            <div class="hidden sm:block sm:ml-6">
              <ul class="items-center justify-between space-x-6 hidden lg:flex ">
                @guest

                <li>
                  <a href="{{ route('login') }}" class="justify-center font-medium tracking-wide text-accent_wine transition-colors duration-200 hover:text-secondary" aria-label="sign-in" title="sign-in">
                    Connexion
                  </a>
                </li>

                <li>
                  <a href="{{ route('register') }}" class="inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide text-main transition duration-200 rounded bg-accent_wine hover:bg-transparent hover:border border-accent_wine hover:text-accent_wine" aria-label="sign-up" title="sign-up">
                    Inscription
                  </a>
                </li>
                @else
                <li>
                  <a href="{{ route('celliers.index') }}" class="justify-center font-medium tracking-wide text-accent_wine transition-colors duration-200 hover:text-secondary" aria-label="celliers" title="celliers">
                    Mes Celliers
                  </a>
                </li>
                <li>
                  <a href="{{route('celliers.creer')}}" class="justify-center font-medium tracking-wide text-accent_wine transition-colors duration-200 hover:text-secondary" aria-label="articles" title="articles">
                    Ajouter Cellier
                  </a>
                </li>
                <li>
                  <a href="{{ route('logout') }}" class="justify-center font-medium tracking-wide text-accent_wine transition-colors duration-200 hover:text-secondary" aria-label="Sign out" title="deconnecter" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Déconnexion
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                </li>
                <li>
                  <a href="/compte" class="inline-flex gap-2 items-center justify-center w-full h-12 pe-6 font-medium tracking-wide text-accent_wine transition duration-200 rounded  hover:text-secondary" aria-label="Compte" title="Compte">
                    <!-- <img class="max-w-[30px]" src="{{ asset('img/svg/user-gold.svg') }}" alt="user-profile"> -->
                    Mon Compte<!--  Affichage du nom Utilisateur. À modifier   -->
                  </a>
                </li>
                @endguest
              </ul>
            </div>
          </div>
        </div>
      </div>
  </nav>