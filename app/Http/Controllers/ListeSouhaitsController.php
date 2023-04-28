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
        $bouteilles = Vino_Bouteille::select(
            'date_achat',
            'garde_jusqua',
            'prix AS prixPaye',
            'quantite AS quantiteBouteille',
            'vino_cellier_id',
            'vino_bouteilles.id AS vino_bouteille_id',
            'millesime',
            'vino_bouteilles.nom AS nomSAQ',
            'vino_bouteilles.image AS imageSAQ',
            'code_saq',
            'vino_bouteilles.description AS descriptionSAQ',
            'prix_saq',
            'url_saq',
            'url_img',
            'vino_format_id',
            'vino_type_id',
            'pays_id',
            'pays',
            'format',
            'type',
            'bouteille_par_celliers.id'
          )
            ->join('bouteille_par_celliers', 'vino_bouteilles.id', '=', 'bouteille_par_celliers.vino_bouteille_id')
            ->join('vino_celliers', 'vino_celliers.id', '=', 'bouteille_par_celliers.vino_cellier_id')
            ->join('vino_formats', 'vino_formats.id', '=', 'vino_bouteilles.vino_format_id')
            ->join('vino_types', 'vino_types.id', '=', 'vino_bouteilles.vino_type_id')
            ->join('pays', 'pays.id', '=', 'vino_bouteilles.pays_id')
            ->where('utilisateurs_id', Auth::user()->id)
            ->get();

        $liste = ListeSouhaits::where('utilisateurs_id', Auth::user()->id)->get();
        //return $liste;
        return view('listeSouhaits', ['bouteilles' => $bouteilles, 'liste' => $liste]);
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
