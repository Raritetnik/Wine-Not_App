@extends('layouts.app')
@section('content')
<div class="">
  <section class="mx-4 px-6 flex flex-col gap-6 mb-8">
    <div class="flex items-center justify-around relative">
      <h2 class="font-black text-gray-600 text-xl" style="max-width: 15ch">Choisissez votre vin à la SAQ!</h2>
      <div class="acc_icon p-5 border rounded-lg flex justify-center" style="width: 100px; height: 100px; border-color: #ABA08D">
        <img src="{{ asset('img/svg/full_bottle.svg') }}" alt="">
        <div class="absolute bottom-0 text-4xl" style="color: #ABA08D; transform: translateY(80%)">&#8595;</div>
      </div>
    </div>
    <div class="flex items-center justify-around relative">
      <h2 class="font-black text-gray-600 text-xl" style="max-width: 15ch">Localisez la bouteille dans notre application</h2>
      <div class="acc_icon p-5 border rounded-lg flex justify-center" style="width: 100px; height: 100px; border-color: #ABA08D">
        <img src="{{ asset('img/svg/form-icon.svg') }}" alt="">
        <div class="absolute bottom-0 text-4xl" style="color: #ABA08D; transform: translateY(80%)">&#8595;</div>
      </div>
    </div>
    <div class="flex items-center justify-around relative">
      <h2 class="font-black text-gray-600 text-xl" style="max-width: 15ch">Attribuez-lui un cellier !</h2>
      <div class="acc_icon p-5 border rounded-lg flex justify-center" style="width: 100px; height: 100px; border-color: #ABA08D">
        <img src="{{ asset('img/svg/barrols.svg') }}" alt="">
        <div class="absolute bottom-0 text-4xl" style="color: #ABA08D; transform: translateY(80%)">&#8595;</div>
      </div>
    </div>
    <div class="flex items-center justify-around relative">
      <h2 class="font-black text-gray-600 text-xl" style="max-width: 15ch">Gérez votre cave à vin comme un pro !</h2>
      <div class="acc_icon p-5 border rounded-lg flex justify-center" style="width: 100px; height: 100px; border-color: #ABA08D">
        <img src="{{ asset('img/svg/empty_bottle.svg') }}" alt="">
      </div>
    </div>
  </section>
  <footer class="flex flex-col items-center mb-8 mx-10">
    <a href="/register" class="text-white py-2 w-full md:max-w-[300px] rounded-md mb-2 flex justify-center" style="background-color: #67375C">Commencer</a>
    <small style="color: #909090">
      Avez-vous déjà un compte?
      <a href="/login" style="color: #67375C">Connecter</a>
    </small>
  </footer>
</div>
@endsection