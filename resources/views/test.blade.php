@extends('layouts.app')
@section('content')

<main class="py-4">
  
  <div class="tab-bar">
    <a href="#" class="tab-icon active">
      <img src="{{ asset('img/svg/log-in.svg') }}" alt="icones"> Quitter
    </a>
    <a href="#" class="tab-icon">
      <img src="{{ asset('img/svg/coeur.svg') }}" alt="icones"> Favoris
    </a>
    <a href="#" class="tab-icon">
      <i class="fa fa-history"></i></a>
    <a href="#" class="tab-icon"><i class="fa fa-user"></i></a>
    <a href="#" class="tab-icon"><i class="fa fa-plus"></i></a>
  </div>
    <div class="container stage">

      <div class="container">
        <div class="tabbar tab-style3">
          <ul class="flex-center">
            <li class="home active" data-where="home"><img src="{{ asset('img/svg/log-in.svg') }}" alt="icones">
                Quitter
              </img>
            </li>
            <li class="products" data-where="products"><img src="{{ asset('img/svg/coeur.svg') }}" alt="icones">
                Favoris
              </img>
            </li>
            <li class="services" data-where="services"><img src="{{ asset('img/svg/clock.svg') }}" alt="icones">
                Historique
              </img>
            </li>
            <li class="about" data-where="about"><img src="{{ asset('img/svg/userNew.svg') }}" alt="icones">
                Profil
              </img>
            </li>
            <li class="help" data-where="help"><img src="{{ asset('img/svg/More.svg') }}" alt="icones">
                More
              </img>
            </li>
            <li class="follow">&nbsp;</li>
          </ul>
        </div>
      </div>
    
    </div>
  </div>
  
  
</main>
</div>
  @endsection