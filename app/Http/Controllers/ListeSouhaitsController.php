<?php

namespace App\Http\Controllers;

use App\Models\Bouteille_Par_Cellier;
use App\Models\ListeSouhaits;
use App\Models\Pays;
use App\Models\Vino_Bouteille;
use App\Models\Vino_Format;
use App\Models\Vino_Type;
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
            if($elem !== "") {
                $bouteille['pays'] = Pays::find($bouteille->pays_id);
                $bouteille['format'] = Vino_Format::find($bouteille->vino_format_id);
                $bouteille['type'] = Vino_Type::find($bouteille->vino_type_id);

                $bouteille['quantite'] = Bouteille_Par_Cellier::where('vino_bouteille_id', $bouteille->id)->first()['quantite'] | 0;
            }
            array_push($listeBouteilles, $bouteille);
        }

        $liste = ListeSouhaits::where('utilisateurs_id', Auth::user()->id)->get();
        return view('listeSouhaits', ['bouteilles' => $listeBouteilles, 'liste' => $liste]);
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
