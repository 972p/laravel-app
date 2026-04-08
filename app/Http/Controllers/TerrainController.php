<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terrain;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TerrainController extends Controller
{
    public function index()
    {
        $terrains = Terrain::all();
        return view('terrains.index', compact('terrains'));
    }

    public function reserver(Request $request, $id) // Utilise $id pour être sûr de la correspondance
    {
        $terrain = Terrain::findOrFail($id);

        $validated = $request->validate([
            'date_debut' => 'required|date|after_or_equal:today',
            'duree_heures' => 'required|integer|min:1|max:4',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Vous devez être connecté.');
        }

        $dateDebut = Carbon::parse($validated['date_debut']);
        $dateFin = $dateDebut->copy()->addHours((int) $validated['duree_heures']);

        // LOGIQUE SIMPLIFIÉE DE CHEVAUCHEMENT
        // Une réservation existe si : (Début_Existant < Fin_Demandée) ET (Fin_Existante > Début_Demandé)
        $overlap = Reservation::where('id_terrain', $terrain->id_terrain)
            ->where(function ($query) use ($dateDebut, $dateFin) {
                $query->where('date_debut', '<', $dateFin)
                    ->where('date_fin', '>', $dateDebut);
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['date_debut' => 'Ce terrain est déjà occupé sur ce créneau.'])->withInput();
        }

        // CRÉATION DE LA RÉSERVATION
        Reservation::create([
            'user_id' => Auth::id(),
            'id_terrain' => $terrain->id_terrain,
            'statut' => 'Validée',
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
        ]);

        return redirect()->route('compte.index')->with('success', 'Terrain réservé avec succès !');
    }
}