<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EleveController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EnseignantDashboardController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AdminController;
use App\Models\Enseignant;
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
Route::get('/', [EleveController::class, 'showStep1'])->name('eleves.step1');
Route::post('/etape1', [EleveController::class, 'postStep1'])->name('eleves.step1.post');
Route::get('/etape2', [EleveController::class, 'showStep2'])->name('eleves.step2');
Route::post('/etape2', [EleveController::class, 'postStep2'])->name('eleves.step2.post');
Route::get('/connexion', [EleveController::class, 'showConnexionForm'])->name('eleves.connexion.form');
Route::post('/connexion', [EleveController::class, 'connecter'])->name('eleves.connexion');
Route::get('/espace', [EleveController::class, 'espace'])->name('eleves.espace');
Route::get('/deconnexion', [EleveController::class, 'deconnexion'])->name('eleves.deconnexion');
Route::get('/admin/enseignants', [AdminController::class, 'enseignants'])->name('admin.enseignants');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


//Route pour enseignants
Route::get('/enseignants/inscription', [EnseignantController::class, 'create'])->name('enseignants.create');
Route::post('/enseignants', [EnseignantController::class, 'store'])->name('enseignants.store');


Route::get('/enseignants/connexion', [EnseignantController::class, 'loginForm'])->name('enseignants.login');
Route::post('/enseignants/connexion', [EnseignantController::class, 'login'])->name('enseignants.auth');
Route::middleware(['auth:enseignant'])->group(function () {
    Route::get('/enseignants/dashboard', [EnseignantDashboardController::class, 'index'])->name('enseignants.dashboard');
    Route::post('/enseignants/notes', [NoteController::class, 'store'])->name('enseignants.notes.store');
});



//Route pour admin
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


// Ajouter un élève ou un enseignant
Route::get('/admin/ajouter', [AdminController::class, 'showAjoutForm'])->name('admin.ajouter');
Route::post('/admin/ajouter/eleve', [AdminController::class, 'ajouterEleve'])->name('admin.ajouter.eleve');
Route::post('/admin/ajouter/enseignant', [AdminController::class, 'ajouterEnseignant'])->name('admin.ajouter.enseignant');

// Modifier un élève ou un enseignant
Route::get('/admin/modifier/{type}/{id}', [AdminController::class, 'showEditForm'])->name('admin.modifier');
Route::post('/admin/modifier/{type}/{id}', [AdminController::class, 'update'])->name('admin.update');

// Supprimer un élève ou un enseignant
Route::delete('/admin/supprimer/{type}/{id}', [AdminController::class, 'delete'])->name('admin.supprimer');

// Routes pour les élèves
Route::get('/admin/eleves/create', [AdminController::class, 'createEleve'])->name('admin.eleves.create');
Route::get('/admin/eleves/{id}/edit', [AdminController::class, 'editEleve'])->name('admin.eleves.edit');
Route::delete('/admin/eleves/{id}', [AdminController::class, 'destroyEleve'])->name('admin.eleves.destroy');

// Routes pour les enseignants
Route::get('/admin/enseignants/create', [AdminController::class, 'createEnseignant'])->name('admin.enseignants.create');
Route::get('/admin/enseignants/{id}/edit', [AdminController::class, 'editEnseignant'])->name('admin.enseignants.edit');
Route::delete('/admin/enseignants/{id}', [AdminController::class, 'destroyEnseignant'])->name('admin.enseignants.destroy');
Route::get('/admin/eleves/{id}/edit', [AdminController::class, 'editEleve'])->name('admin.eleves.edit');
Route::put('/admin/eleves/{id}', [AdminController::class, 'updateEleve'])->name('admin.eleves.update');
Route::delete('/admin/eleves/{id}', [AdminController::class, 'destroyEleve'])->name('admin.eleves.destroy');
Route::delete('/admin/enseignants/{id}', [AdminController::class, 'destroyEnseignant'])->name('admin.enseignants.destroy');
Route::get('/admin/enseignants/{id}/edit', [AdminController::class, 'editEnseignant'])->name('admin.enseignants.edit');
Route::put('/admin/enseignants/{id}', [AdminController::class, 'updateEnseignant'])->name('admin.enseignants.update');
Route::get('/admin/enseignants/create', [AdminController::class, 'createEnseignant'])->name('admin.enseignants.create');
Route::post('/admin/enseignants', [AdminController::class, 'storeEnseignant'])->name('admin.enseignants.store');






Route::get('/enseignants/create', [EnseignantController::class, 'create'])->name('admin.enseignants.create'); // si utilisé
Route::post('/enseignants', [EnseignantController::class, 'store'])->name('enseignants.store');

Route::get('/enseignants/login', [EnseignantController::class, 'loginForm'])->name('enseignants.login');
Route::post('/enseignants/login', [EnseignantController::class, 'login'])->name('enseignants.login.submit');

Route::get('/enseignants/dashboard', function () {
    $enseignant = Enseignant::first(); // ou find(1), ou selon l’utilisateur connecté
    return view('enseignants.dashboard', compact('enseignant'));
})->name('enseignants.dashboard');
Route::get('/enseignants/dashboard', [EnseignantController::class, 'dashboard'])->name('enseignants.dashboard');


Route::post('/enseignants/notes', [EnseignantController::class, 'storeNote'])->name('enseignants.notes.store');
//Route pdf
Route::get('/admin/telecharger-classe/{classe}', [AdminController::class, 'telechargerListeClasse'])->name('admin.telecharger.pdf');
Route::get('/admin/telecharger-enseignants', [AdminController::class, 'telechargerEnseignants'])->name('admin.enseignants.pdf');

