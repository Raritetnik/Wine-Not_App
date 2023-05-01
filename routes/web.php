<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\CellierController;
use App\Http\Controllers\ListeSouhaitsController;
use App\Http\Controllers\WebcamController;
use App\Http\Controllers\SAQController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * Les routes de connexion
 */
Auth::routes();
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('login', [LoginController::class, 'loginCustom'])->name('login.custom');
Route::get('/compte', [HomeController::class, 'afficherCompte'])->name('compte');

// Page Accueil
Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::get('/home', [CellierController::class, 'index'])->middleware('auth');
/**
 * Les liens de cellier
 */
// Catalogue des celliers
Route::get('/celliers', [App\Http\Controllers\CellierController::class, 'index'])->name('celliers.index')->middleware('auth');
Route::get('/creer-cellier', [App\Http\Controllers\CellierController::class, 'creer'])->name('celliers.creer')->middleware('auth');
Route::post('/creer-cellier', [App\Http\Controllers\CellierController::class, 'insererCellier'])->name('celliers.insererCellier')->middleware('auth');

// Intérieur du cellier
Route::get('/celliers-modifier/{cellier}', [App\Http\Controllers\CellierController::class, 'modifier'])->name('celliers.modifier')->middleware('auth');
Route::put('/celliers-modifier/{cellier}', [App\Http\Controllers\CellierController::class, 'enregistrerModification'])->middleware('auth');
Route::get('celliers/{cellier}/details-bouteille/{bouteille_par_cellier}', [App\Http\Controllers\CellierController::class, 'afficherFicheBouteille'])->name('celliers.detailBouteille')->middleware('auth');

// Action avec les bouteilles dans le cellier
Route::get('/celliers/{cellier}', [App\Http\Controllers\CellierController::class, 'afficher'])->name('celliers.afficher')->middleware('auth');
Route::put('/celliers/{cellier}', [App\Http\Controllers\CellierController::class, 'ajouterBouteille'])->middleware('auth');
Route::put('/celliers/{cellier}/{idbouteille}', [App\Http\Controllers\CellierController::class, 'modifierNbBouteille'])->middleware('auth');

/**
 * Les liens de Bouteilles
 */
Route::get('/bouteille/{idBouteille}', [BouteilleController::class, 'show'])->name('bouteille.show')->middleware('auth');
Route::get('/bouteilles', [BouteilleController::class, 'listeBouteilles'])->name('bouteilles');
// Route::get('/creer-bouteille', [App\Http\Controllers\BouteilleController::class, 'creer'])->name('bouteilles.creer')->middleware('auth');
Route::get('/ajouter-bouteille', [BouteilleController::class, 'ajouterBouteille'])->name('bouteille.create')->middleware('auth');
Route::post('/ajouter-bouteille', [BouteilleController::class, 'insererBouteille'])->name('bouteille.inserer')->middleware('auth');
Route::put('/recherche-bouteille', [BouteilleController::class, 'rechercheBouteille'])->name('bouteille.saq')->middleware('auth');
/**
 * Les liens de Script Loader SAQ
 */
Route::get('/saq', )->name('bouteilles')->middleware('auth');
Route::get('/DEsaq', [SAQController::class, 'uploadVins'])->name('bouteilles.dd')->middleware('auth');


/**
 * Les routes de test
 */
Route::get('/test', [HomeController::class, 'testPage'])->name('test');
Route::get('/favoris', [ListeSouhaitsController::class, 'index'])->name('favoris');

Route::get('webcam', [WebcamController::class, 'index']);
Route::post('webcam', [WebcamController::class, 'store'])->name('webcam.capture');

/**
 * Les routes avec les fonctionnalités d'API
 */
Route::get('/api.listeSouhait/{id}', [ListeSouhaitsController::class, 'verifierFavoris'])->name('verification.favoris');
Route::get('//api.delete-bouteille/{id}', [BouteilleController::class, 'supprimerBouteille'])->name('supprimer.bouteille');
Route::post('/api.listeSouhait/{id}', [ListeSouhaitsController::class, 'modifierFavoris'])->name('modification.favoris');
Route::get('/api.bouteilles', [BouteilleController::class, 'listeBouteilles'])->name('bouteilles');