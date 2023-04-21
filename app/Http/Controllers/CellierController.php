<?php

namespace App\Http\Controllers;

use App\Models\Vino_Cellier;
use App\Models\Vino_Bouteille;
use App\Models\Bouteille_Par_Cellier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CellierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Si une session existe, octroyer le numéro d'id de la session à l'utilisateur
        // Rechercher tous les celliers oû l'utilisateurs_id correspond à la session en cours
        // Afficher les celliers
        // Sinon afficher login
        if(Auth::id()){
            $utilisateur_id = Auth::id();
            $cellier = Vino_Cellier::select()
            ->where('vino_celliers.utilisateurs_id', $utilisateur_id)
            ->get();
            return view('cellier.index', ['celliers' => $cellier]);
        }
        else {
            return redirect(route('login'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cellier.creer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Vino_Cellier $cellier)
    {
        // ** doit ajouter Auth qui vient du login
        $request['utilisateurs_id'] = Auth::id();
        $cellier = Vino_Cellier::create([
        'nom' => $request->nom,
        'quantite_max' => $request->quantite_max,
        'description' => $request->description,
        'image' => $request->image,
        'utilisateurs_id' => $request->utilisateurs_id,
        ]);
        $cellier->save();
        return redirect(route('cellier.index'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBouteille(Request $request, Vino_Cellier $cellier)
    {
        $bouteille = Bouteille_Par_Cellier::create([
            'date_achat' => $request->date_achat,
            'garde_jusqua' => $request->garde_jusqua,
            'prix' => $request->prix,
            'quantite' => $request->quantite,
            'millesime' => $request->millesime,
            'vino_cellier_id'=> $cellier->id,
            'vino_bouteille_id'=> $request->vino_bouteille_id  // vient de vue.js
          ]);

          $bouteille->save();
          return redirect(route('cellier.afficher', $cellier->id));
    }

    /**
     * Afficher un cellier et les bouteilles de ce cellier
     * passer en param de fonction afficher $cellier = celliers.id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $unCellier = Vino_Cellier::find($id);
        $bouteilles = Vino_Bouteille::select(
            'vino_bouteilles.id as idBouteille',
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
            'type')
        ->join('bouteille_par_celliers', 'vino_bouteilles.id', '=', 'bouteille_par_celliers.vino_bouteille_id')
        ->join('vino_celliers', 'vino_celliers.id', '=', 'bouteille_par_celliers.vino_cellier_id')
        ->join('vino_formats', 'vino_formats.id', '=', 'vino_bouteilles.vino_format_id')
        ->join('vino_types', 'vino_types.id', '=', 'vino_bouteilles.vino_type_id')
        ->join('pays', 'pays.id', '=', 'vino_bouteilles.pays_id')
        ->where('vino_celliers.id', $id)
        ->get();

        return view('cellier.afficher', [
            'cellier' => $unCellier,
            'bouteilles' => $bouteilles
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Vino_Cellier $cellier)
    {
        return view('cellier.modifier', ['cellier' => $cellier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vino_Cellier $cellier)
    {
        $cellier->update([
            'nom' => $request->nom,
            'quantite_max' => $request->quantite_max,
            'description' => $request->description,
            'image' => $request->image,
          ]);
          return redirect(route('cellier.index'))->withSuccess('Article mis à jour.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * ==========================================================
     * =================   Autres méthodes  =====================
     * ==========================================================
     */

     public function modifierNbBouteille(Request $request, $cellier_id, $bouteille_id){
        // vérifier dans les modèles si on peut trouver un enregistrement correspondant
        $cellier = Vino_Cellier::findOrFail($cellier_id);
        $bouteille = Vino_Bouteille::findOrFail($bouteille_id);

        $bouteilleParCellier = Bouteille_Par_Cellier::select()
        ->where([
            ['vino_bouteille_id', '=', $bouteille_id],
            ['vino_cellier_id', '=', $cellier_id]
        ])->update(['quantite' => $request->input('nbbouteille')]);

    }
}
