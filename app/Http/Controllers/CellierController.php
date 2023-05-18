<?php

namespace App\Http\Controllers;

use App\Models\Vino_Bouteille;
use App\Models\Bouteille_Par_Cellier;
use App\Models\ListeSouhaits;
use App\Models\Vino_Cellier;
use App\Models\Vino_Type;
use App\Models\Pays;
use App\Models\Note;
use App\Models\Vino_Format;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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
    if (Auth::id()) {
      $utilisateur_id = Auth::id();
      $celliers = Vino_Cellier::select()
        ->where('vino_celliers.utilisateurs_id', $utilisateur_id)
        ->get();
      foreach ($celliers as $cellier) {
        $cellier->quantiteBouteilles = Bouteille_Par_Cellier::where('vino_cellier_id', $cellier->id)->get()
          ->count();
      }
      $quantitecelliers = count($celliers);
      return view('celliers.index', ['celliers' => $celliers, 'quantitecelliers' => $quantitecelliers ]);
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
    if (!Vino_Cellier::where('id', $idCellier)->exists() || $cellier->utilisateurs_id != Auth::user()->id) {
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
      'utilisateur_id',
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
      ->leftJoin('vino_formats', 'vino_formats.id', '=', 'vino_bouteilles.vino_format_id')
      ->leftJoin('vino_types', 'vino_types.id', '=', 'vino_bouteilles.vino_type_id')
      ->leftJoin('pays', 'pays.id', '=', 'vino_bouteilles.pays_id')
      ->where('vino_celliers.id', $idCellier)
      ->get();
    // envoyer les informations additionnelles
    $listeSouhaits = ListeSouhaits::where('utilisateurs_id', Auth::user()->id)->get();
    $type = Vino_Type::all();
    $pays = Pays::all();
    return view('celliers.afficher', [
      'cellier' => $cellier,
      'bouteilles' => $bouteilles,
      'liste' => $listeSouhaits,
      'type' => $type,
      'pays' => $pays
    ]);
    // chercher dans la classe Vino_Cellier la ligne correspondante au id ($cellier)
    // nommer les colonnes et donner des alias pour unicité
  }

  // Afficher formulaire de modification des informations de la table vino_celliers
  public function modifier(Vino_Cellier $cellier)
  {
    // Vérification sécurité si cellier appartient à utilisateur / Sinon retour sur page celliers
    if ($cellier->utilisateurs_id != Auth::user()->id) {
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
    return redirect(route('celliers.afficher', ['cellier'=>$cellier->id]))->withSuccess('Information mise à jour.');
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
    if ($vino_cellier->utilisateurs_id != Auth::user()->id) {
      return redirect(route('celliers.index'));
    }
    if ($bouteille_par_cellier->vino_cellier_id != $vino_cellier->id) {
      return redirect(route('celliers.index'));
    }

    //pour avoir les celliers qui appartients a l'utilisateur
    $celliers = auth()->user()->celliers;
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
      DB::raw('COALESCE(notes.note, 0) AS note'), // ajouter une valeur par défaut de 0 si la note est nulle ou vide
      'vino_celliers.nom AS cellier'
    )
    ->join('vino_bouteilles', 'vino_bouteilles.id', '=', 'bouteille_par_celliers.vino_bouteille_id')
    ->join('vino_celliers', 'bouteille_par_celliers.vino_cellier_id', '=', 'vino_celliers.id')
    ->join('vino_formats', 'vino_formats.id', '=', 'vino_bouteilles.vino_format_id')
    ->join('vino_types', 'vino_types.id', '=', 'vino_bouteilles.vino_type_id')
    ->join('pays', 'pays.id', '=', 'vino_bouteilles.pays_id')
    ->leftJoin('notes', 'vino_bouteilles.id', '=', 'notes.vino_bouteilles_id')
    ->where([
      ['bouteille_par_celliers.id', '=', $bouteille_par_cellier->id]
    ])
    ->get();

    // Passer à travers le tableau et calculer le total payé par l'utilisateur;
    $bouteilleDetail[0]['total'] = $bouteilleDetail[0]['quantite'] * $bouteilleDetail[0]['prix_saq'];
    return view('celliers.detailBouteille', ['bouteille' => $bouteilleDetail[0], 'celliers' => $celliers]);
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
    Bouteille_Par_Cellier::where('vino_cellier_id', $request->CellierID)->delete();
    Vino_Cellier::find($request->CellierID)->delete();
    if ($request->redirect) {
      return redirect('/celliers');
    }
  }



  public function deplacerBouteille(Request $request, $vino_cellier, $bouteille_par_cellier)
  {
    $bouteilleParCellier = Bouteille_Par_Cellier::findOrFail($bouteille_par_cellier);
    $nouveauCellier = $request->nouveau_cellier;
    $newQuantite = $request->quantite;
    $totalQuantite = $bouteilleParCellier->quantite;

    $uCelliers = auth()->user()->celliers;
    if (count($uCelliers) <= 1) {
      return redirect()->back()->withErrors(["unCellier" =>"Vous devez avoir plus d'un cellier pour déplacer des bouteilles."]);
    }
    

    // Vérifier s'il existe déjà un enregistrement Bouteille_Par_Cellier avec le même vino_bouteille_id dans le cellier cible
    $existingRecord = Bouteille_Par_Cellier::where('vino_cellier_id', $nouveauCellier)
      ->where('vino_bouteille_id', $bouteilleParCellier->vino_bouteille_id)
      ->first();

    if ($existingRecord) {
      // S'il existe un enregistrement existant, ajouter la nouvelle quantité à la quantité existante
      $existingRecord->quantite += $newQuantite;
      $existingRecord->save();
    } else {
      // S'il n'y a pas d'enregistrement existant, en créer un nouveau
      $newBouteilleParCellier = new Bouteille_Par_Cellier([
        'date_achat' => $bouteilleParCellier->date_achat,
        'garde_jusqua' => $bouteilleParCellier->garde_jusqua,
        'prix' => $bouteilleParCellier->prix,
        'quantite' => $newQuantite,
        'vino_cellier_id' => $nouveauCellier,
        'vino_bouteille_id' => $bouteilleParCellier->vino_bouteille_id,
        'millesime' => $bouteilleParCellier->millesime,
      ]);
      $newBouteilleParCellier->save();
    }

    // Si la nouvelle quantité n'est pas égale à la quantité totale, mettre à jour la quantité de l'enregistrement original
    if ($newQuantite != $totalQuantite) {
      $oldQuantite = $totalQuantite - $newQuantite;
      $bouteilleParCellier->quantite = $oldQuantite;
      $bouteilleParCellier->save();
    } else {
     // Si la nouvelle quantité est égale à la quantité totale, supprimer l'enregistrement original
      $bouteilleParCellier->delete();
    }
   

    return redirect()->route('celliers.afficher', ['cellier' => $vino_cellier]);
  }
}
