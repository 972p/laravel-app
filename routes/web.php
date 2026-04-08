<?php

use Illuminate\Support\Facades\Route;

// --- Contrôleurs Utilisateurs ---
use App\Http\Controllers\BallonController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\TerrainController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ChaussureController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\PlanningController;

// --- Contrôleurs Admin ---
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminTerrainController;
use App\Http\Controllers\Admin\AdminChaussureController;
use App\Http\Controllers\Admin\AdminReservationController;

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('library.index');
})->name('home');

Route::get('/ballons', [BallonController::class, 'index'])->name('ballons.index');
Route::get('/chaussures', [ChaussureController::class, 'index'])->name('chaussures.index');
Route::get('/terrains', [TerrainController::class, 'index'])->name('terrains.index');

// Authentification
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});

/*
|--------------------------------------------------------------------------
| Routes Protégées (Membres connectés)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // --- LE PLANNING (Indépendant) ---
    Route::get('/planning', [PlanningController::class, 'index'])->name('planning.index');
    Route::delete('/planning/annuler/{id}', [PlanningController::class, 'destroy'])->name('planning.destroy');

    // --- MON COMPTE ---
    Route::get('/compte', [CompteController::class, 'index'])->name('compte.index');

    // --- ACTIONS D'EMPRUNT & RÉSERVATION ---
    Route::post('/chaussures/{chaussure}/emprunter', [ChaussureController::class, 'emprunter'])->name('chaussures.emprunter');
    Route::post('/ballons/{ballon}/emprunter', [BallonController::class, 'emprunter'])->name('ballons.emprunter');
    Route::post('/terrains/{terrain}/reserver', [TerrainController::class, 'reserver'])->name('terrains.reserver');

    // --- RETOURS & HISTORIQUE ---
    Route::get('/retours', [EmpruntController::class, 'index'])->name('emprunts.index');
    Route::post('/emprunts/{emprunt}/retour', [EmpruntController::class, 'retourner'])->name('emprunts.retourner');

    // --- STATISTIQUES ---
    Route::post('/stats/simuler', [StatistiqueController::class, 'simuler'])->name('stats.simuler');
});

/*
|--------------------------------------------------------------------------
| Routes Administration (Admin uniquement)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/', function () {
        return redirect()->route('admin.users.index');
    })->name('index');

    // CRUD classiques
    Route::resource('users', AdminUserController::class);
    Route::resource('terrains', AdminTerrainController::class);
    Route::resource('chaussures', AdminChaussureController::class);

    /**
     * GESTION DES RÉSERVATIONS ADMIN
     * On ajoute ->except(['edit', 'show']) car tu modifies les statuts 
     * en direct (Alpine.js) dans la liste. Cela supprime l'erreur 
     * "Missing required parameter for [Route: admin.reservations.edit]".
     */
    Route::resource('reservations', AdminReservationController::class)->except(['edit', 'show']);
});