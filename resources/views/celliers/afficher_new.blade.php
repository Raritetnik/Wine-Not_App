
@extends('layouts.app')
@section('content')

<div class="flex justify-center mb-7 mt-5">
  <section class="px-6 flex flex-col w-full lg:w-3/5">
    <header class="mb-8 md:hidden">
      <a href="/" class="text-accent_wine uppercase tracking-wide font-bold">
        <img src="{{ asset('img/svg/logoWn.svg') }}" alt="logo-wineNot" class="mx-auto" width="120">
      </a>
    </header>
  <div class="bg-gray-100">
    <div class="container flex items-center justify-between py-2 px-4 mx-auto">
      <div class="flex items-center">
        <label for="nom_cellier" class="text-section_title sm:text-xl font-bold mr-3"> Cellier: </label>
        <span class="text-lg font-bold leading-none sm:text-xl md:container md:mx-auto" > Mon Cellier </span>
        <span class="mr-12"></span>
      </div>
      <div class="flex items-right ml-auto mr-6">
        <label class="cursor-pointer mr-0">
        <svg width="23" height="23" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M11.7349 3.53024H6.72527C4.72124 3.53024 3.71922 3.53024 2.95378 3.92025C2.28048 4.26331 1.73307 4.81072 1.39001 5.48402C1 6.24946 1 7.25148 1 9.25551V19.2747C1 21.2788 1 22.2808 1.39001 23.0462C1.73307 23.7195 2.28048 24.2669 2.95378 24.61C3.71922 25 4.72124 25 6.72527 25H16.7445C18.7485 25 19.7505 25 20.516 24.61C21.1893 24.2669 21.7367 23.7195 22.0798 23.0462C22.4698 22.2808 22.4698 21.2788 22.4698 19.2747V14.2651M8.15656 17.8434H10.1539C10.7374 17.8434 11.0291 17.8434 11.3037 17.7775C11.5471 17.7191 11.7798 17.6227 11.9932 17.4919C12.2339 17.3444 12.4402 17.1381 12.8528 16.7255L24.2589 5.31939C25.247 4.33127 25.247 2.72921 24.2589 1.74109C23.2708 0.752971 21.6687 0.75297 20.6806 1.74109L9.27449 13.1472C8.8619 13.5598 8.65561 13.7661 8.50809 14.0068C8.37729 14.2202 8.28091 14.4529 8.22247 14.6963C8.15656 14.9709 8.15656 15.2626 8.15656 15.8461V17.8434Z" stroke="#ABA08D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          {{-- <a href="{{route('celliers.modifier', $cellier->id)}}" class=""> --}}
      </div>
      <div class="flex items-center">
        <label class="cursor-pointer ml-auto mr-3">
        <svg width="23" height="24" viewBox="0 0 25 26" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M24.4292 23.3337L23.0602 24.7189C22.6055 25.1791 21.8702 25.1791 21.4203 24.7189L16.5925 19.8388C16.3748 19.6185 16.2539 19.3199 16.2539 19.0067V18.2088C14.5462 19.5598 12.3984 20.3625 10.0619 20.3625C4.50368 20.3625 0 15.8054 0 10.1813C0 4.5571 4.50368 0 10.0619 0C15.6202 0 20.1238 4.5571 20.1238 10.1813C20.1238 12.5455 19.3305 14.7188 17.9954 16.4467H18.7839C19.0935 16.4467 19.3885 16.569 19.6062 16.7893L24.4292 21.6695C24.8791 22.1296 24.8791 22.8736 24.4292 23.3337ZM16.6409 10.1813C16.6409 6.50035 13.6997 3.52428 10.0619 3.52428C6.42415 3.52428 3.48297 6.50035 3.48297 10.1813C3.48297 13.8622 6.42415 16.8382 10.0619 16.8382C13.6997 16.8382 16.6409 13.8622 16.6409 10.1813Z" fill="#ABA08D" fill-opacity="0.75"/>
          </svg>
          <input type="checkbox" name="filtre" class="checkbox-filtre">
      </div>
    </div>
  </div>

  <div class="conteneur-de-toute-la-page">
    <!-- Rest of the content -->
  </div>

  <div class="container mx-auto py-8 px-8 sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <!-- Rest of the content -->
  </div>
@endsection