<?php

namespace App\Http\Controllers;

use App\Jobs\LoaderDataSAQ;
use App\Models\SAQ;
use App\Models\Vino_Bouteille;
use Illuminate\Http\Request;

class SAQController extends Controller
{
    /**
     * Démarrage de fonctionnalité de téléchargement des bouteilles SAQ dans la BD
     * Avant l'execution, appeler la commande dans le terminal:
     * --> php artisan queue:work
     */
    public function uploadVins() {
        LoaderDataSAQ::dispatch();
    }

    /**
     * API -> retourne la liste des tous les bouteilles SAQ dans la BD
     *  ...Seule barre recherche a accès
     */
    public function show(SAQ $saq) {
        $listeBouteilles = Vino_Bouteille::all();
        return view('bouteille.show', ['bouteilles' => $listeBouteilles]);
    }
}
