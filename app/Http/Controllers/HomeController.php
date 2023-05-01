<?php

namespace App\Http\Controllers;

use App\Models\Bouteille_Par_Cellier;
use App\Models\User;
use App\Models\Vino_Cellier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function updateCompte(Request $request) {

      // Récupération de l'utilisateur par l'id
      $user = User::find(Auth::user()->id);
      // Validation des champs email et password
      if($request->has('courriel')) {
        $this->validate($request, [
          'courriel' => 'required|email',
          'nom' => 'required|string|max:100',
          'prenom' => 'required|string|max:100',
        ]);
        $user->prenom = $request->prenom;
        $user->nom = $request->nom;
        $user->courriel = $request->courriel;
        $user->save();
      }

      if($request->oldPassword !== '') {
        $this->validate($request, [
          'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        if(Hash::check($request->oldPassword, $user->password)) {
          $user['password'] = Hash::make($request->password);
          $user->save();
          return redirect('/compte')->withSuccess('Les modifications a été effectuée avec succès !');
        } else {
          return redirect()->back()->withErrors(['oldPassword' => "Le mot de passe actuel de l'utilisateur est incorrect."]);
        }
      }
      return redirect('/compte');
    }
}