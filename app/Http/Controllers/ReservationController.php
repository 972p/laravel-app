<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emprunt; // On reste sur Emprunt pour les chaussures
use App\Models\Reservation; // Pour les terrains
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    /**
     * Affiche le planning (Réservations Chaussures + Terrains)
     */
    public function index()
    {
        $user = auth()->user();

        // 1. On récupère les emprunts de MATÉRIEL (Chaussures)
        // On utilise 'with' pour charger la relation chaussure et éviter le crash
        $emprunts = Emprunt::where('user_id', $user->id)
            ->with('chaussure')
            ->get();

        // 2. On récupère les réservations de TERRAINS
        $reservations = Reservation::where('user_id', $user->id)
            ->with('terrain')
            ->get();

        // On envoie les DEUX variables à la vue
        return view('planning.index', compact('emprunts', 'reservations'));
    }
    /**
     * Annuler une réservation (Chaussure ou Terrain)
     */
    public function destroy($id)
    {
        $user = Auth::user();

        // On tente de trouver l'ID dans les chaussures d'abord
        $shoeRes = Emprunt::find($id);
        if ($shoeRes) {
            if ($shoeRes->user_id !== $user->id && !$user->is_admin) {
                abort(403);
            }
            $shoeRes->delete();
            return redirect()->route('planning.index')->with('success', 'Réservation de chaussures annulée.');
        }

        // Sinon, on cherche dans les terrains
        $terrainRes = Reservation::find($id);
        if ($terrainRes) {
            if ($terrainRes->user_id !== $user->id && !$user->is_admin) {
                abort(403);
            }
            $terrainRes->delete();
            return back()->with('success', 'Réservation de terrain annulée.');
        }

        return back()->withErrors('Réservation non trouvée.');
    }
}