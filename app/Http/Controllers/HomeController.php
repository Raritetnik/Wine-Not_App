<?php

namespace App\Http\Controllers;

use App\Models\Bouteille_Par_Cellier;
use App\Models\Vino_Cellier;
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
      $listeCelliers = Vino_Cellier::where('utilisateurs_id', Auth::user()->id)->get();
      $informations['quantiteBouteilles'] = 0;
      $informations['prixBouteilles'] = 0;
      foreach ($listeCelliers as $cellier) {
        $informations['quantiteBouteilles'] += count(Bouteille_Par_Cellier::where('vino_cellier_id', $cellier->id)->get());

        // Ajustement des prix de chaque bouteille
        $listeBouteilles = Bouteille_Par_Cellier::where('vino_cellier_id', $cellier->id)->get();
        foreach ($listeBouteilles as $bouteille) {
          $informations['prixBouteilles'] += $bouteille->prix;
        }
      }
      return view('compte', ["utilisateur" =>Auth::user(), 'userInfo' => $informations]);
    }

    public function updateCompte() {

    }
}