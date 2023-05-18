<?php

namespace App\Http\Controllers;

use App\Models\Bouteille_Par_Cellier;
use App\Models\Historique;
use App\Models\ListeSouhaits;
use App\Models\Note;
use App\Models\User;
use App\Models\Vino_Cellier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{

/**
     * Affichage de la page d'instruction
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $cookieValue = Cookie::get('myapp_session');
      echo($cookieValue);
      if ($cookieValue && Auth::check()) {
        return redirect('/celliers');
      } else if(Auth::check()) {
        return view('home');
      } else {
        return redirect('/celliers');
      }
    }

  // TEST CODE
  public function testPage()
  {
    return view('test');
  }

  public function home(){
    if(Auth::check()) {
      $cookieValue = encrypt(Auth::id(). '|' .Auth::user()->courriel);
      Cookie::queue('myapp_session', $cookieValue, 60 * 24 * 30); // Cookie will expire in 30 days
    }
    return view('home');
  }

  /**
   * Affichage de la page de compte
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
        $informations['prixBouteilles'] += $bouteille->prix | 0;
      }
    }
    return view('compte', ["utilisateur" =>Auth::user(), 'userInfo' => $informations]);
  }

  /**
   * Enregistrement de modification sur le compte
   */
  public function modifierCompte(Request $request) {

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

      /**
       * Vérification du mot de passe, avant de le modifier
       */
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

  public function supprimerUtilisateur(Request $request) {
    if($request->Utilisateur['id'] == Auth::id()){

      // Supprimer contenu en lien avec l'utilisateur
      Note::where('utilisateurs_id', Auth::id())->delete();
      ListeSouhaits::where('utilisateurs_id', Auth::id())->delete();
      Historique::where('utilisateur_id', Auth::id())->delete();

      $celliers = Vino_Cellier::where('utilisateurs_id', Auth::id())->get();
      foreach ($celliers as $cellier) {
        Bouteille_Par_Cellier::where('vino_cellier_id', $cellier->id)->delete();
      }
      Vino_Cellier::where('utilisateurs_id', Auth::id())->delete();

      User::find($request->Utilisateur['id'])->delete();
      Auth::logout();
      return true;
    } else {
      return false;
    }
  }
}