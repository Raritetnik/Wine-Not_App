<?php

namespace App\Http\Controllers;

use App\Models\ListeSouhaits;
use App\Models\Vino_Bouteille;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class ListeSouhaitsController extends Controller
{
    /**
     * Affichage de catalogue des bouteillés favoris
     */
    public function index()
    {
        $liste = ListeSouhaits::where('utilisateurs_id', Auth::user()->id)->get();
        $listeBouteilles = [];
        foreach ($liste as $elem) {
            $bouteille = Vino_Bouteille::find($elem->vino_bouteilles_id);
            array_push($listeBouteilles, $bouteille);
        }
        return view('listeSouhaits', ['bouteilles' => $listeBouteilles]);
    }

    /**
     * Vérification si l'utilisateur a la bouteille en favoris
     */
    public function verifierFavoris($id) {
        return (ListeSouhaits::where('vino_bouteilles_id', $id)->where('utilisateurs_id', Auth::user()->id)->exists()) ? true : false;
    }

    /**
     * Modification de l'état favoris par l'utilisateur
     */
    public function modifierFavoris(Request $request) {
        if(!ListeSouhaits::where('vino_bouteilles_id', $request['BouteilleID'])->where('utilisateurs_id', Auth::user()->id)->exists()) {
            ListeSouhaits::create([
                'vino_bouteilles_id' => $request['BouteilleID'],
                'utilisateurs_id' => Auth::user()->id,
            ]);
        } else {
            ListeSouhaits::where('vino_bouteilles_id', $request['BouteilleID'])->where('utilisateurs_id', Auth::user()->id)->delete();
        }
    }
}
