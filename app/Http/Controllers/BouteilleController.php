<?php

namespace App\Http\Controllers;

use App\Models\Bouteille_Par_Cellier;
use App\Models\Historique;
use App\Models\Pays;
use App\Models\SAQ;
use App\Models\Vino_Bouteille;
use App\Models\Vino_Cellier;
use App\Models\Vino_Format;
use App\Models\Vino_Type;
use Carbon\Carbon;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;



class BouteilleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * La methode fournit les informations nécessaires au formulaire
     * d'ajout d'une bouteille de SAQ. Si lien vien du bouton dans un cellier
     *$idCellier correspond au cellier autrement le tableau est vide.
     */
    public function ajouterBouteille(Vino_Cellier $idCellier)
    {
        // return $cellier;
        $bouteilles = $this->listeBouteilles();
        $celliers = auth()->user()->celliers;
        $pays = Pays::all()->sortBy('pays');
        $types = Vino_Type::all();
        $formats = Vino_Format::all()->sortBy('format');
        return view('bouteille.ajouter', ['celliers' => $celliers, 'pays' => $pays, 'types' => $types, 'formats' => $formats, 'bouteilles' => $bouteilles, 'idCellier' => $idCellier->id, 'dateActuelle' => Carbon::now()]);
    }
    /*
     Ajout de bouteilles non listée.  Si lien vien du bouton dans un cellier
     $idCellier correspond au cellier autrement le tableau est vide
     */
    public function ajouterBouteillePasSAQ(Vino_Cellier $idCellier)
    {
        $celliers = auth()->user()->celliers;
        $pays = Pays::all()->sortBy('pays');
        $types = Vino_Type::all();
        $formats = Vino_Format::all()->sortBy('format');
        return view('bouteille.ajouterPasSAQ', ['celliers' => $celliers, 'pays' => $pays, 'types' => $types, 'formats' => $formats, 'idCellier' => $idCellier->id, 'dateActuelle' => Carbon::now()]);
    }

    /**
     * La fonction ajoute une bouteille de la SAQ existant
     * dans le cellier selectionné par l'utilisateur
     */
    public function insererBouteille(Request $request)
    {
        // récupérer le id de l'utilisateur qui est loggé dans sa session
        $user_id = auth()->user()->id;

        $data['utilisateur_id'] = $user_id;
        $data['nom'] = $request->nom;
        $data['quantite'] = $request->quantite;
        $data['vino_cellier_id'] = $request ->vino_cellier_id;
        // Validation si on a les données et retirer autrement (pour pas updater ex : pays= null)
        if ($request->description !== null) {
            $data['description'] = $request->description;
        }
        if ($request->image !== null) {
            $data['image'] = $request->image;
        }
        if ($request->pays_id !== null) {
            $data['pays_id'] = $request->pays_id;
        }
        if ($request->vino_type_id !== null) {
            $data['vino_type_id'] = $request->vino_type_id;
        }
        if ($request->vino_format_id !== null) {
            $data['vino_format_id'] = $request->vino_format_id;
        }
        $data['date_achat'] = $request->date_achat ? $request->date_achat : now()->timezone('America/Toronto')->format('Y-m-d');
        if ($request->garde_jusqua !== null) {
            $data['garde_jusqua'] = $request->garde_jusqua;
        }

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
            ]);
            $imageName = time().'.'.$request->image->extension();
            // Public Folder
            $request->image->move(public_path('storage/uploads'), $imageName);
            // $request->image->storeAs('images', $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = null;
        }

        // enregistrer dans vino_bouteille en premier
        $vinoBouteille = new Vino_Bouteille;
        $vinoBouteille->fill($data);
        $vinoBouteille->save();

        // récupérer l'id pour le passer en paramètre
        $data['vino_bouteille_id'] = $vinoBouteille->id;

        // enregistrer dans bouteille par cellier ensuite
        $bouteilleParCellier = new Bouteille_Par_Cellier;
        $bouteilleParCellier->fill($data);
        $bouteilleParCellier->save();

        Historique::create([
            'bouteille_id' => $data['vino_bouteille_id'],
            'cellier_id' => $data['vino_cellier_id'],
            'utilisateur_id' => Auth::id(),
            'create_at' => Carbon::now()
        ]);
        return redirect(route('celliers.afficher', $request->vino_cellier_id));
    }

    public function insererBouteillePasSAQ(Request $request)
    {
         // récupérer le id de l'utilisateur qui est loggé dans sa session
         $user_id = auth()->user()->id;

         $data['utilisateur_id'] = $user_id;
         $data['nom'] = $request->nom;
         $data['quantite'] = $request->quantite;
         $data['vino_cellier_id'] = $request ->vino_cellier_id;
         // Validation si on a les données et retirer autrement (pour pas updater ex : pays= null)
         if ($request->description !== null) {
             $data['description'] = $request->description;
         }
         if ($request->image !== null) {
             $data['image'] = $request->image;
         }
         if ($request->pays_id !== null) {
             $data['pays_id'] = $request->pays_id;
         }
         /*if ($request->vino_type_id !== null) {
             $data['vino_type_id'] = $request->vino_type_id;
         }*/
         if ($request->vino_format_id !== null) {
             $data['vino_format_id'] = $request->vino_format_id;
         }
         if ($request->prix_saq !== null) {
            $data['prix_saq'] = $request->prix_saq;
        }
        if ($request->millesime !== null) {
            $data['millesime'] = $request->millesime;
        }
         $data['date_achat'] = $request->date_achat ? $request->date_achat : now()->timezone('America/Toronto')->format('Y-m-d');
         if ($request->garde_jusqua !== null) {
            $data['garde_jusqua'] = $request->garde_jusqua;
        }

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
            ]);
            $imageName = time().'.'.$request->image->extension();
            // Public Folder **** sur serveur enlever public_path
            $request->image->move(public_path('storage/uploads'), $imageName);
            // $request->image->storeAs('images', $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = 'placeholder.png';
        }

        /*
        vérification pour voir si on a les autorisations d'enregistrer des images ou doc

        $storagePath = storage_path('app/public'); // Chemin vers le répertoire de stockage
        if (is_writable($storagePath)) {
            return "Vous avez les autorisations d'enregistrer des fichiers localement.";
        } else {
            return "Vous n'avez pas les autorisations d'enregistrer des fichiers localement.";
        }
        */


        // enregistrer dans vino_bouteille en premier
        $vinoBouteille = new Vino_Bouteille;
        $vinoBouteille->fill($data);
        $vinoBouteille->save();

        // récupérer l'id pour le passer en paramètre
        $data['vino_bouteille_id'] = $vinoBouteille->id;

        // enregistrer dans bouteille par cellier ensuite
        $bouteilleParCellier = new Bouteille_Par_Cellier;
        $bouteilleParCellier->fill($data);
        $bouteilleParCellier->save();

        Historique::create([
            'bouteille_id' => $data['vino_bouteille_id'],
            'cellier_id' => $data['vino_cellier_id'],
            'utilisateur_id' => Auth::id(),
            'create_at' => Carbon::now()
        ]);
        return redirect(route('celliers.afficher', $request->vino_cellier_id));
    }





    public function rechercheBouteille(Request $request)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
            'vino_bouteille_id' => 'required|integer|min:1',
        ]);

        $celliers = auth()->user()->celliers;

        $bouteilleValidation = Bouteille_Par_Cellier::where('vino_cellier_id', $request->vino_cellier_id)
            ->where('vino_bouteille_id', $request->vino_bouteille_id)
            ->exists();

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

        Historique::create([
            'bouteille_id' => $request->vino_bouteille_id,
            'cellier_id' => $request->vino_cellier_id,
            'utilisateur_id' => Auth::id(),
            'create_at' => Carbon::now()
        ]);

        return redirect(route('celliers.afficher', $request->vino_cellier_id));
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

    public function modifierBouteille(Vino_Cellier $idCellier, Vino_Bouteille $idBouteille)
    {
        $bouteilleModifie = Vino_Bouteille::select(
            'bouteille_par_celliers.id AS id',
            'bouteille_par_celliers.vino_cellier_id AS vino_cellier_id',
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
            'vino_celliers.nom AS cellier_nom',
            'vino_celliers.utilisateurs_id',
        )
            ->join('bouteille_par_celliers', 'vino_bouteilles.id', 'bouteille_par_celliers.vino_bouteille_id')
            ->join('vino_celliers', 'vino_celliers.id', 'bouteille_par_celliers.vino_cellier_id', 'utilisateurs_id')
            ->leftJoin('vino_formats', 'vino_formats.id', 'vino_bouteilles.vino_format_id')
            ->leftJoin('vino_types', 'vino_types.id', 'vino_bouteilles.vino_type_id')
            ->leftJoin('pays', 'pays.id', 'vino_bouteilles.pays_id')
            ->where('bouteille_par_celliers.vino_bouteille_id', $idBouteille->id)
            ->where('vino_celliers.id', $idCellier->id)
            ->get();
        $pays = Pays::all();
        $types = Vino_type::all();
        $formats = Vino_format::all();
        // seulement passer en paramètre les celliers de l'utilisateur
        $user_id = auth()->user()->id;
        $celliers = Vino_cellier::where('utilisateurs_id', $user_id)->get();
        // passer en paramètre l'objet de bouteille à modifier et les autres tables pour les menus déroulants
        return view('bouteille.modifier', [
            'bouteille' => $bouteilleModifie[0],
            'types' => $types,
            'formats' => $formats,
            'pays' => $pays,
            'celliers' => $celliers
        ]);
    }

    public function enregistrerModifierBouteille(Request $request, Vino_Cellier $idCellier, Vino_Bouteille $idBouteille)
    {
        // récupérer le id de l'utilisateur qui est loggé dans sa session
        $user_id = auth()->user()->id;

        $data['utilisateur_id'] = $user_id;
        // Validation si on a les données et retirer autrement (pour pas updater ex : pays= null)
        if ($request->nom !== null) {
            $data['nom'] = $request->nom;
        }
        if ($request->description !== null) {
            $data['description'] = $request->description;
        }
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
            ]);
            $imageName = time().'.'.$request->image->extension();
            // Public Folder
            $request->image->move(public_path('storage/uploads'), $imageName);
            // $request->image->storeAs('images', $imageName);
            $data['image'] = $imageName;
        } else {
            $data['image'] = 'placeholder.png';
        }
        if ($request->pays_id !== null) {
            $data['pays_id'] = $request->pays_id;
        }
        if ($request->vino_type_id !== null) {
            $data['vino_type_id'] = $request->vino_type_id;
        }
        if ($request->vino_format_id !== null) {
            $data['vino_format_id'] = $request->vino_format_id;
        }
        if ($request->quantite !== null) {
            $data['quantite'] = $request->quantite;
        }
        if ($request->description !== null) {
            $data['description'] = $request->description;
        }
        if ($request->prix_saq !== null) {
           $data['prix_saq'] = $request->prix_saq;
       }
       if ($request->millesime !== null) {
           $data['millesime'] = $request->millesime;
       }
        $data['date_achat'] = $request->date_achat ? $request->date_achat : now()->timezone('America/Toronto')->format('Y-m-d');
        if ($request->garde_jusqua !== null) {
           $data['garde_jusqua'] = $request->garde_jusqua;
       }

        $vinoBouteille = Vino_Bouteille::where('id', $idBouteille->id)
            ->first();

        if ($vinoBouteille) {
            $vinoBouteille->fill($data);
            $vinoBouteille->save();
        }

        $bouteilleParCellier = Bouteille_Par_Cellier::where('vino_bouteille_id', $idBouteille->id)
            ->where('vino_cellier_id', $idCellier->id)
            ->first();

        if ($bouteilleParCellier) {
            $bouteilleParCellier->fill($data);
            $bouteilleParCellier->save();
        }

        // rediriger vers la page précédente avec un message de succès
        return redirect('/celliers' . '/' . $idCellier->id)->withSuccess('Information mise à jour.');
    }

    /**
     * Supprimer la bouteille du cellier
     */
    public function supprimerBouteille(Request $request)
    {
        Bouteille_Par_Cellier::find($request->BouteilleID)->delete();
        return redirect('/celliers' . '/' . $request->CellierID);
    }

    public function afficherHistorique()
    {
        $bHistorique = Historique::where('utilisateur_id', Auth::id())->get();
        $bouteilles = [];
        foreach ($bHistorique as $bouteille) {
            $bouteilleHis = Vino_Bouteille::find($bouteille->bouteille_id);
            $bouteilleHis['pays'] = (Pays::where("id",$bouteilleHis->pays_id)->exists()) ? Pays::find($bouteilleHis->pays_id)['pays'] : 'Pays indéfini';
            $bouteilleHis['format'] = (Vino_Format::where("id",$bouteilleHis->vino_format_id)->exists()) ? Vino_Format::find($bouteilleHis->vino_format_id)['format'] : 'Format indéfini';
            $bouteilleHis['date'] = $bouteille->created_at;
            array_push($bouteilles, $bouteilleHis);
        }
        return view('bouteille.historique', ['bouteilles' => $bouteilles]);
    }
    public function ajouterHistorique(Request $request)
    {
        $boutID = (int) $request->params['bouteilleID'];
        $cellID = (int) $request->params['cellierID'];
        Historique::create([
            'bouteille_id' => $boutID,
            'cellier_id' => $cellID,
            'utilisateur_id' => Auth::id(),
            'create_at' => Carbon::now()
        ]);
        Bouteille_Par_Cellier::where('vino_bouteille_id', $boutID)->where('vino_cellier_id', $cellID)->delete();
    }

    public function supprimerHistorique()
    {
        Historique::where('utilisateur_id', Auth::id())->delete();
        return $this->afficherHistorique();
    }
    /**
     * Ajouter une note (évaluation) à la bouteille on reçoit par composante de Vue.js
     */

    public function enregistrerNoteBouteille(Request $request, Vino_Bouteille $idBouteille)
    {
        $utilisateurId = Auth::user()->id;

        $noteBD = Note::where([
            ['vino_bouteilles_id', '=', $idBouteille->id],
            ['utilisateurs_id', '=', $utilisateurId]
        ])->first();

        if ($noteBD) {
            // La note existe, donc nous la mettons à jour
            $noteBD->update(['note' => $request->note]);
        } else {
            // La note n'existe pas, nous la créons
            Note::create([
                'vino_bouteilles_id' => $idBouteille->id,
                'utilisateurs_id' => $utilisateurId,
                'note' => $request->note
            ]);
        }
    }
}