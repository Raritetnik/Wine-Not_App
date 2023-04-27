<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
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

    public function afficherCompte() {
      return view('compte', ['utilisateur' => Auth::user()]);
    }
}