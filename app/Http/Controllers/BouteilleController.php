<?php

namespace App\Http\Controllers;

use App\Models\Bouteille_Par_Cellier;
use App\Models\Pays;
use App\Models\Vino_Bouteille;
use App\Models\Vino_Cellier;
use App\Models\Vino_Format;
use App\Models\Vino_Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BouteilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // return view('bouteille.index')->with('bouteilles', json_decode($liste, true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajouterBouteille()
    {
        $celliers = auth()->user()->celliers;
        $pays = Pays::all()->sortBy('pays');
        $types = Vino_Type::all();
        $formats = Vino_Format::all()->sortBy('format');
        return view('bouteille.ajouter', ['celliers' => $celliers, 'pays' => $pays, 'types' => $types, 'formats' => $formats]);
    }


    public function insererBouteille(Request $request)
    {

        $request->validate([
            'nom' => 'required|min:5|max:100',
            'date_achat' => 'required|date',
            'quantite' => 'required|integer|min:1',
            'prix_saq' => 'required|numeric|min:0',
            'image' => 'image|mimes:jpeg,png|max:2048',
            'vino_cellier_id' => 'required|integer|min:1'
        ]);
        $path = $request->file('image')->store('uploads', 'public');

        $nBouteille = new Vino_Bouteille();
        $nBouteille->image = $path;
        $nBouteille->nom = $request->nom;
        $nBouteille->prix_saq = $request->prix_saq;
        $nBouteille->vino_format_id = $request->vino_format_id;
        $nBouteille->vino_type_id = $request->vino_type_id;
        $nBouteille->pays_id = $request->pays_id;
        $nBouteille->save();


        $bouteilleParCellier = new Bouteille_Par_Cellier();
        $bouteilleParCellier->quantite = $request->quantite;
        $bouteilleParCellier->date_achat = $request->date_achat;
        $bouteilleParCellier->garde_jusqua = $request->garde_jusqua;
        $bouteilleParCellier->vino_cellier_id = $request->vino_cellier_id;
        $bouteilleParCellier->prix = $nBouteille->prix_saq * $bouteilleParCellier->quantite;
        $bouteilleParCellier->vino_bouteille_id = $nBouteille->id;
        $bouteilleParCellier->save();

        return redirect(route('celliers.afficher', $request->vino_cellier_id ));
    }


    public function rechercheBouteille(Request $request)
    {
        $celliers = auth()->user()->celliers;

        $bouteilleValidation = Bouteille_Par_Cellier::whereIn('vino_cellier_id', $celliers->pluck('id')->toArray())
            ->where('vino_bouteille_id', $request->vino_bouteille_id)
            ->first();

        if ($bouteilleValidation) {
            $totalBouteille = $bouteilleValidation->quantite + $request->quantite;
            $bouteilleValidation->update(['quantite' => $totalBouteille]);
        } else {
            $bouteille = Bouteille_Par_Cellier::create([
                'date_achat' => $request->date_achat,
                'garde_jusqua' => $request->garde_jusqua,
                'prix' => $request->prix,
                'quantite' => $request->quantite,
                'millesime' => $request->millesime,
                'vino_cellier_id' => $request->vino_cellier_id,
                'vino_bouteille_id' => $request->vino_bouteille_id // vient de vue.js
            ]);
            $bouteille->save();
        }

        return redirect(route('celliers.afficher', $request->vino_cellier_id ));
    }



   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bouteilleDetail = Bouteille_Par_Cellier::select()
            ->join('vino_bouteilles', 'vino_bouteilles.id', '=', 'bouteille_par_celliers.vino_bouteille_id')
            ->where([
                ['vino_bouteille_id', '=', $id]
            ])
            ->get();
        // return $bouteilleDetail;
        $bouteilleDetail[0]['total'] = $bouteilleDetail[0]['quantite'] * $bouteilleDetail[0]['prix_saq'];
        return view('bouteille.show', ['bouteille' => $bouteilleDetail[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

<<<<<<< HEAD


public function modifierBouteille(Bouteille_Par_Cellier $idBouteille)
    {
        //return $idBouteille;

        $bouteilleModifie = Bouteille_Par_Cellier::select()
        ->join('vino_bouteilles', 'vino_bouteilles.id','vino_bouteille_id')
        ->where('vino_bouteilles.id', $idBouteille)
        ->where('utilisateur_id', auth()->user()->id)
        ->get();

        return $bouteilleModifie;



        // Vérifier que la bouteille appartient bien à l'utilisateur connecté
        // $utilisateur_id = auth()->user()->id;
        // $cellier_id = $bouteille->vino_cellier_id;
        // $bouteille = $vino_bouteille_id;
        // if (!$bouteille->cellier->estProprietaire($utilisateur_id)) {
        //     abort(403, 'Unauthorized action.');
        // }
>>>>>>> master
        
        // // Valider les données du formulaire
        // $request->validate([
        //     'nom' => 'required|min:5|max:100',
        //     'date_achat' => 'required|date',
        //     'quantite' => 'required|integer|min:1',
        //     'prix' => 'required|numeric|min:0',
        //     'millesime' => 'nullable|integer|min:1900|max:' . date('Y'),
        //     'garde_jusqua' => 'nullable|date',
        // ]);
    
        // // Mettre à jour la bouteille et la sauvegarder
        // $bouteille->vino_bouteille->update([
        //     'nom' => $request->nom,
        //     'prix_saq' => $request->prix,
        //     'vino_format_id' => $request->vino_format_id,
        //     'vino_type_id' => $request->vino_type_id,
        //     'pays_id' => $request->pays_id,
        // ]);
        // $bouteille->update([
        //     'date_achat' => $request->date_achat,
        //     'quantite' => $request->quantite,
        //     'prix' => $request->prix * $request->quantite,
        //     'millesime' => $request->millesime,
        //     'garde_jusqua' => $request->garde_jusqua,
        // ]);
    
        // Rediriger vers la page du cellier contenant la bouteille modifiée
        return redirect(route('celliers.afficher', $cellier_id));
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
     * API de VUE: retourne la liste des bouteilles
     */
    public function listeBouteilles()
    {
        $liste = Vino_Bouteille::all();
        echo (json_encode($liste));
    }

    // public function supprimer($cellier_id, $vino_bouteille_id){
    //     $utilisateur_id = auth()->user()->id;
    //     // 
    //     // Vérifier que la bouteille appartient bien au cellier de l'utilisateur connecté
    //     $bouteille_id = Bouteille_Par_Cellier::where('id', $vino_bouteille_id)
    //         ->where('vino_cellier_id', $cellier_id)
    //         ->whereHas('cellier', function($query) use ($utilisateur_id) {
    //             $query->where('utilisateurs_id', $utilisateur_id);
    //         })
    //         ->firstOrFail();
        
    //     // Supprimer la bouteille de la base de données
    //     $bouteille_id->delete();
        
    //     // Supprimer l'élément de la liste DOM
    //     $this->emitUp('supprimerBouteille', $bouteille_id);
    // }
}
