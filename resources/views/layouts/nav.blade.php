<nav id="main-nav" class="lg:bg-gray-50 lg:shadow-sm md:bg-transparent md:shadow-none py-1 relative">
    <!-- Logo -->
    <div class="absolute inset-0 flex items-center justify-center z-0">
      <a href="{{ route('celliers.index') }}">
        <img src="{{ asset('img/svg/logoWn.svg') }}" alt="Logo">
      </a>
    </div>
    <div class="relative flex h-[70px] items-center justify-end lg:hidden"></div>
    <!--

        Mobile Menu
    -->
    <!-- from-accent_wine to-main bg-gradient-to-t -->
    <div id="mobile-menu" class="z-index-menu pt-2 transition duration-300 hidden lg:hidden bg-accent_wine fixed bottom-0 left-0 w-full">
      <div class="space-y-5 flex flex-col items-center justify-center pb-8 mt-1">
        <div class="absolute z-50 left-5 top-15">
        </div>
        @guest
        
        <a href="{{ route('login') }}" class="justify-center tracking-wide font-regular text-xl text-main transition-colors duration-200 hover:text-secondary" aria-label="sign-in" title="sign-in">
          Connexion
        </a>
        
        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-md py-2.5 px-6 font-regular tracking-wide text-main text-xl transition duration-200 hover:text-secondary" aria-label="sign-up" title="sign-up">
          Inscription
        </a>

        @else
        <!-- button fermer -->
        <button type="button" id="mobile-menu-btn-close" class="absolute top-0 right-3.5 text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-lg px-6 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
          <span class="sr-only">Fermer</span>
      </button>
        <a href="{{route('celliers.creer')}}" class="justify-center font-regular tracking-wide text-xl text-main transition-colors duration-200 hover:text-secondary" aria-label="articles" title="articles">
          Ajouter Cellier
        </a>
        <a href="/historique" class="justify-center font-regular tracking-wide text-xl text-main transition-colors duration-200 hover:text-secondary" aria-label="articles" title="articles">
          Historique
        </a>
        <a href="{{ route('logout') }}" class="justify-center font-regular tracking-wide text-xl text-main transition-colors duration-200 hover:text-secondary" aria-label="Sign out" title="deconnecter" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Déconnexion
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
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