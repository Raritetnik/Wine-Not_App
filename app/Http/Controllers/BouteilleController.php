<?php

namespace App\Http\Controllers;

use App\Models\Bouteille_Par_Cellier;
use App\Models\Pays;
use App\Models\SAQ;
use App\Models\Vino_Bouteille;
use App\Models\Vino_Cellier;
use App\Models\Vino_Format;
use App\Models\Vino_Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class BouteilleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        $bouteilles = $this->listeBouteilles();

        $celliers = auth()->user()->celliers;
        $pays = Pays::all()->sortBy('pays');
        $types = Vino_Type::all();
        $formats = Vino_Format::all()->sortBy('format');
        return view('bouteille.ajouter', ['celliers' => $celliers, 'pays' => $pays, 'types' => $types, 'formats' => $formats, 'bouteilles' => $bouteilles]);
    }


    public function insererBouteille(Request $request)
    {
        $dateAchat = $request->date_achat ? $request->date_achat : now()->timezone('America/Toronto')->format('Y-m-d');
  
        $request->validate([
            'nom' => 'required|min:5|max:100',
            'qty' => 'required|integer|min:1',
            'prix_saq' => 'min:0',
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
        $nBouteille->utilisateur_id = Auth::id();
        $nBouteille->save();

        $bouteilleParCellier = new Bouteille_Par_Cellier();
        $bouteilleParCellier->quantite = $request->qty;
        $bouteilleParCellier->date_achat = $dateAchat;
        $bouteilleParCellier->garde_jusqua = $request->garde_jusqua;
        $bouteilleParCellier->vino_cellier_id = $request->vino_cellier_id;
        $bouteilleParCellier->prix = $nBouteille->prix_saq * $bouteilleParCellier->quantite;
        $bouteilleParCellier->vino_bouteille_id = $nBouteille->id;
        $bouteilleParCellier->save();

        return redirect(route('celliers.afficher', $request->vino_cellier_id));
    
    }
        
      

       

       

        
        
         

    
    

    public function rechercheBouteille(Request $request)

    {
       
        $request->validate([
           
            'quantite' => 'required|integer|min:1',
            
        ]);

        $celliers = auth()->user()->celliers;

        $bouteilleValidation = Bouteille_Par_Cellier::whereIn('vino_cellier_id', $celliers->pluck('id')->toArray())
            ->where('vino_bouteille_id', $request->vino_bouteille_id)
            ->first();

        if ($bouteilleValidation) {
            $totalBouteille = $bouteilleValidation->quantite + $request->quantite;
            $bouteilleValidation->update(['quantite' => $totalBouteille]);
        } else {
            $dateAchat = $request->date_achat ? $request->date_achat : now()->timezone('America/Toronto')->format('Y-m-d');

            $bouteille = Bouteille_Par_Cellier::create([
                'date_achat' => $dateAchat,
                'garde_jusqua' => $request->garde_jusqua,
                'prix' => $request->prix_saq * $request->quantite,
                'quantite' => $request->quantite,
                'millesime' => $request->millesime,
                'vino_cellier_id' => $request->vino_cellier_id,
                'vino_bouteille_id' => $request->vino_bouteille_id, // vient de vue.js
            ]);
            $bouteille->save();
        }

        return redirect(route('celliers.afficher', $request->vino_cellier_id));
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
        return Vino_Bouteille::query()
        ->join('vino_formats', 'vino_bouteilles.vino_format_id', '=', 'vino_formats.id')
        ->join('vino_types', 'vino_bouteilles.vino_type_id', '=', 'vino_types.id')
        ->join('pays', 'vino_bouteilles.pays_id', '=', 'pays.id')
        ->get([
            'vino_bouteilles.*',
            'vino_formats.format as format',
            'vino_types.type as type',
            'pays.pays as pays'
        ]);
    }

    public function modifierBouteille(Vino_Bouteille $idBouteille)
    {

        $bouteilleModifie = Vino_Bouteille::select(
            '*',
            'bouteille_par_celliers.id AS id',
            'vino_cellier_id',
            'vino_bouteilles.id AS vino_bouteille_id',
            'date_achat',
            'garde_jusqua',
            'prix AS prixPaye',
            'quantite AS quantiteBouteille',
            'millesime',
            'vino_bouteilles.nom AS nom',
            'vino_bouteilles.image AS image',
            'code_saq',
            'vino_bouteilles.description AS description',
            'prix_saq',
            'url_saq',
            'url_img',
            'vino_format_id',
            'vino_formats.format',
            'vino_type_id',
            'vino_types.type',
            'pays_id',
            'pays',
            'format',
            'type',
            'vino_celliers.nom AS cellier_nom'
          )
        ->join('bouteille_par_celliers', 'vino_bouteilles.id','bouteille_par_celliers.vino_bouteille_id')
        ->join('vino_celliers', 'vino_celliers.id', 'bouteille_par_celliers.vino_cellier_id')
        ->join('vino_formats', 'vino_formats.id', 'vino_bouteilles.vino_format_id')
        ->join('vino_types', 'vino_types.id', 'vino_bouteilles.vino_type_id')
        ->join('pays', 'pays.id', 'vino_bouteilles.pays_id')
        ->where('vino_bouteilles.id', $idBouteille->id)
        ->get();
        $pays = Pays::all();
        $types= Vino_type::all();
        $formats= Vino_format::all();
        $celliers = Vino_cellier::all();
        // passer en paramètre l'objet de bouteille à modifier et les autres tables pour les menus déroulants
        return view('bouteille.modifier', ['bouteille' => $bouteilleModifie[0],
                                            'types'=>$types,
                                            'formats' => $formats,
                                            'pays' => $pays,
                                            'celliers' => $celliers]);
    }
    
    public function enregistrerModifierBouteille(Request $request, Vino_Bouteille $idBouteille){
        // $bouteilleModifie = Bouteille_Par_Cellier::select()
        // ->join('vino_bouteilles', 'vino_bouteilles.id','vino_bouteille_id')
        // ->where('vino_bouteilles.id', $idBouteille)
        // ->where('utilisateur_id', auth()->user()->id)
        // ->get();

        $request->update([
            'nom' => $request->nom,
            'quantite_max' => $request->quantite_max,
            'description' => $request->description,
            'image' => $request->image,
          ]);
          return redirect(route('celliers.index'))->withSuccess('Information mise à jour.');
        }
        return $bouteilleModifie;
    }

    /**
     * Supprimer la bouteille du cellier
     */
    public function supprimerBouteille(Request $request)
    {
        Bouteille_Par_Cellier::find($request->BouteilleID)->delete();
    }
}