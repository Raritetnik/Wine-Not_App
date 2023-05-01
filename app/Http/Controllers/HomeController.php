<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Affichage de la page d'instruction
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function testPage()
    {
      return view('test');
    }

    /**
     * Affichage de la page de compte -> modification
     */
    public function afficherCompte() {
      return view('compte', ["utilisateur" =>Auth::user()]);
    }
}