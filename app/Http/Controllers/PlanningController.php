<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Emprunt;
use Illuminate\Support\Facades\Auth;

class PlanningController extends Controller
{
    /**
     * Affiche le planning de l'utilisateur (Emprunts + Réservations)
     */
    public function index()
    {
        $user = Auth::user();

        // On récupère les données pour ton tableau
        $emprunts = Emprunt::where('user_id', $user->id)
            ->with(['chaussure', 'ballon'])
            ->get();

        $reservations = Reservation::where('user_id', $user->id)
            ->with('terrain')
            ->get();

        // ICI : On dit explicitement d'utiliser resources/views/planning/index.blade.php
        return view('planning.index', compact('emprunts', 'reservations'));
    }

    /**
     * Permet à l'utilisateur d'annuler sa propre réservation
     */
    public function destroy($id)
    {
        // On cherche par id_reservation (ton nom de colonne)
        $reservation = Reservation::where('id_reservation', $id)
            ->where('user_id', Auth::id()) // Sécurité : l'utilisateur ne peut supprimer que la sienne
            ->firstOrFail();

        $reservation->delete();

        return redirect()->route('planning.index')->with('success', 'Réservation annulée avec succès.');
    }
}