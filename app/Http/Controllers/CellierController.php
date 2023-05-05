<?php

namespace App\Http\Controllers;

use App\Models\Vino_Bouteille;
use App\Models\Bouteille_Par_Cellier;
use App\Models\ListeSouhaits;
use App\Models\Vino_Cellier;
use App\Models\Vino_Type;
use App\Models\Pays;
use App\Models\Vino_Format;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class Controler
 * Gère les requêtes HTTP
 *
 * @author Jonathan Martel
 * @version 1.0
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */

class CellierController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  // Affichage du ou des celliers appartenant à l'utilisateur qui est inscrit
  // **Ajouter Auth
  public function index()
  {



    // Si une session existe, octroyer le numéro d'id de la session à l'utilisateur
    // Rechercher tous les celliers oû l'utilisateurs_id correspond à la session en cours
    // Afficher les celliers
    // Sinon afficher login
    if(Auth::id()){
      $utilisateur_id = Auth::id();
      $celliers = Vino_Cellier::select()
      ->where('vino_celliers.utilisateurs_id', $utilisateur_id)
      ->get();
      foreach ($celliers as $cellier) {
        $cellier->quantiteBouteilles = Bouteille_Par_Cellier::where('vino_cellier_id',$cellier->id)->get()
          ->count();
      }

      return view('celliers.index', ['celliers' => $celliers]);
    }
    else {
      return redirect(route('login'));
    }
  }
  // formulaire de création d'un cellier
  public function creer()
  {
    return view('celliers.creer');
  }

  // Enregistrement dans la bd
  public function insererCellier(Request $request)
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
    return redirect(route('celliers.index'));
  }
  // afficher un cellier et les bouteilles de ce cellier
  // passer en param de fonction afficher $cellier = celliers.id
  public function afficher($idCellier)
  {
    $cellier = Vino_Cellier::find($idCellier);

    // Vérification sécurité si cellier appartient à utilisateur / Sinon retour sur page celliers
    if($cellier->utilisateurs_id != Auth::user()->id) {
      return redirect(route('celliers.index'));
    }

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
      ->where('vino_celliers.id', $idCellier)
      ->get();


      $listeSouhaits = ListeSouhaits::where('utilisateurs_id', Auth::user()->id)->get();
      $type=Vino_Type::all();
      $pays=Pays::all();
      return view('celliers.afficher', ['cellier' => $cellier,
                                        'bouteilles' => $bouteilles,
                                        //'bouteillesJulie' => $bouteilles,
                                        'liste' => $listeSouhaits,
                                        'type' => $type,
                                        'pays' => $pays] );
    // chercher dans la classe Vino_Cellier la ligne correspondante au id ($cellier)
    // nommer les colonnes et donner des alias pour unicité
  }

  // Afficher formulaire de modification des informations de la table vino_celliers
  public function modifier(Vino_Cellier $cellier)
  {
    // Vérification sécurité si cellier appartient à utilisateur / Sinon retour sur page celliers
    if($cellier->utilisateurs_id != Auth::user()->id) {
      return redirect(route('celliers.index'));
    } else {
      return view('celliers.modifier', ['cellier' => $cellier]);
    }
  }
  // Enregistrer dans la bd les modifications de la table vino_celliers
  public function enregistrerModification(Request $request, Vino_Cellier $cellier)
  {
    $cellier->update([
      'nom' => $request->nom,
      'quantite_max' => $request->quantite_max,
      'description' => $request->description,
      'image' => $request->image,
    ]);
    return redirect(route('celliers.index'))->withSuccess('Information mise à jour.');
  }

  public function modifierNbBouteille(Request $request, $cellier_id, $bouteille_id)
  {
    // vérifier dans les modèles si on peut trouver un enregistrement correspondant
    // **utiliser findOrFail en développement**
    $cellier = Vino_Cellier::findOrFail($cellier_id);
    $bouteille = Vino_Bouteille::findOrFail($bouteille_id);

    Bouteille_Par_Cellier::select()
    ->where([
      ['vino_bouteille_id', '=', $bouteille_id],
      ['vino_cellier_id', '=', $cellier_id]
    ])->update(['quantite' => $request->input('nbbouteille')]);
  }

  // Param $id = bouteille_par_cellier
  // Afficher fiche détail de bouteille
  public function afficherFicheBouteille(Vino_Cellier $vino_cellier, Bouteille_Par_Cellier $bouteille_par_cellier)
  {
    // Vérification sécurité si cellier appartient à utilisateur / Sinon retour sur page celliers
    if($vino_cellier->utilisateurs_id != Auth::user()->id) {
      return redirect(route('celliers.index'));
    }
    // joindre les tables pour avoir info sur la bouteille
    // $bouteille_par_cellier->id est la clé primaire
    $bouteilleDetail = Bouteille_Par_Cellier::select(
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
      'vino_type_id',
      'pays_id',
      'pays',
      'format',
      'type',
      'vino_celliers.nom AS cellier'  //pour ajouter le nom du cellier sur la fiche detaile
    )
    ->join('vino_bouteilles', 'vino_bouteilles.id', '=', 'bouteille_par_celliers.vino_bouteille_id')
    ->join('vino_celliers', 'bouteille_par_celliers.vino_cellier_id', '=', 'vino_celliers.id')
    ->join('vino_formats', 'vino_formats.id', '=', 'vino_bouteilles.vino_format_id')
    ->join('vino_types', 'vino_types.id', '=', 'vino_bouteilles.vino_type_id')
    ->join('pays', 'pays.id', '=', 'vino_bouteilles.pays_id')
    ->where([
      ['bouteille_par_celliers.id', '=', $bouteille_par_cellier->id]
    ])
    ->get();
    // Passer à travers le tableau et calculer le total payé par l'utilisateur;
    $bouteilleDetail[0]['total'] = $bouteilleDetail[0]['quantite']*$bouteilleDetail[0]['prix_saq'];
    return view('celliers.detailBouteille', ['bouteille' => $bouteilleDetail[0]]);
  }

  /**
   * Supprime la bouteille dans le cellier
   */
  public function supprimerBouteille($cellier_id, $bouteille_id)
  {
      // Récupérer l'objet Bouteille_Par_Cellier correspondant à l'id de la bouteille passée en paramètre
      $bouteille_par_cellier = Bouteille_Par_Cellier::findOrFail($bouteille_id);

      // Supprimer l'objet de la base de données
      $bouteille_par_cellier->delete();

      // Rediriger vers la page d'affichage du cellier
      return redirect(route('celliers.afficher', $cellier_id));
  }

  /**
   * Supprimer la bouteille du cellier
   */
  public function supprimerCellier(Request $request)
  {
    // Supprime le bouteilles du cellier
    Bouteille_Par_Cellier::where('vino_cellier_id', $request->CellierID)->delete();
    Vino_Cellier::find($request->CellierID)->delete();
    if($request->redirect) {
      return redirect('/celliers');
  }
  }
}