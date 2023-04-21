<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BouteilleController;
use App\Http\Controllers\CellierController;
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

// Page Accueil
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

/**
 * Les liens de cellier
 */
// Catalogue des celliers
Route::get('/celliers', [CellierController::class, 'index'])->name('cellier.index')->middleware('auth');
Route::get('/creer-cellier', [CellierController::class, 'create'])->name('cellier.creer')->middleware('auth');
Route::post('/creer-cellier', [CellierController::class, 'store'])->name('cellier.enregistrer')->middleware('auth');

// Intérieur du cellier
Route::get('/celliers/{cellier}', [CellierController::class, 'show'])->name('cellier.afficher')->middleware('auth');
Route::get('/celliers-modifier/{cellier}', [CellierController::class, 'edit'])->name('cellier.modifier')->middleware('auth');
Route::put('/celliers-modifier/{cellier}', [CellierController::class, 'update'])->middleware('auth');

// Action avec les bouteilles dans le cellier
Route::put('/celliers/{cellier}/{idbouteille}', [CellierController::class, 'modifierNbBouteille'])->middleware('auth');
Route::put('/celliers/{cellier}', [CellierController::class, 'storeBouteille'])->middleware('auth');

/**
 * Les liens de Bouteilles
 */
Route::get('/bouteille/{idBouteille}', [BouteilleController::class, 'show'])->name('bouteille.show')->middleware('auth');
Route::get('/bouteilles', [BouteilleController::class, 'listeBouteilles'])->name('bouteilles');

/**
 * Les liens de Script Loader SAQ
 */
Route::get('/saq', )->name('bouteilles')->middleware('auth');
Route::get('/DEsaq', [SAQController::class, 'uploadVins'])->name('bouteilles.dd')->middleware('auth');


/**
 * Les routes de test
 */
Route::get('/test', [HomeController::class, 'testPage'])->name('test');