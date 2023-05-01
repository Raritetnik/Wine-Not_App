<?php

namespace App\Http\Controllers;

use App\Models\Bouteille_Par_Cellier;
use App\Models\Vino_Bouteille;
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

        //return view('bouteille.index')->with('bouteilles', json_decode($liste, true));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bouteilles.creer');
    }
    public function insererBouteille(Request $request)
    {
      // ** doit ajouter Auth qui vient du login
      $request['utilisateurs_id'] = Auth::id();
      $bouteille = Vino_Bouteille::create([
        'nom' => $request->nom,
            'date_achat' => $request->date_achat,
            'garde_jusqua'=> $request->date_achat,
            'quantite AS quantiteBouteille'=> $request->quantité,
            'image' => $request->image,
            'utilisateurs_id' => $request->utilisateurs_id,
      ]);
      $bouteille->save();
      return redirect(route('celliers.index'));
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
        $bouteilleDetail[0]['total'] = $bouteilleDetail[0]['quantite']*$bouteilleDetail[0]['prix_saq'];
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
        $liste = Vino_Bouteille::all();
        echo(json_encode($liste));
    }

    /**
     * Supprimer la bouteille du cellier
     */
    public function supprimerBouteille(Request $request) {
        Bouteille_Par_Cellier::find($request->BouteilleID)->delete();
    }
}
