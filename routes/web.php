<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BallonController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\TerrainController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ChaussureController;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('library.index');
});

Route::get('/ballons', [BallonController::class, 'index']);
Route::get('/chaussures', [ChaussureController::class, 'index']);
Route::get('/terrains', [TerrainController::class, 'index']);

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Http\Controllers\StatistiqueController;

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/retours', [EmpruntController::class, 'index']);
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::get('/compte', [CompteController::class, 'index'])->name('compte.index');
    Route::post('/stats/simuler', [StatistiqueController::class, 'simuler'])->name('stats.simuler');
    Route::post('/chaussures/{id}/emprunter', [ChaussureController::class, 'emprunter'])->name('chaussures.emprunter');
    Route::post('/emprunts/{id}/retour', [EmpruntController::class, 'retourner'])->name('emprunts.retourner');
    Route::post('/terrains/{terrain}/reserver', [TerrainController::class, 'reserver'])->name('terrains.reserver');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminTerrainController;
use App\Http\Controllers\Admin\AdminChaussureController;
use App\Http\Controllers\Admin\AdminReservationController;

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function() {
        return redirect()->route('admin.users.index');
    })->name('index');
    
    Route::resource('users', AdminUserController::class);
    Route::resource('terrains', AdminTerrainController::class);
    Route::resource('chaussures', AdminChaussureController::class);
    Route::resource('reservations', AdminReservationController::class);
});