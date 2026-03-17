<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terrain;

class TerrainController extends Controller
{
    public function index()
    {
        $terrains = Terrain::all();
        return view('terrains.index', compact('terrains'));
    }

    public function reserver(Request $request, Terrain $terrain)
    {
        $validated = $request->validate([
            'date_debut' => 'required|date|after_or_equal:today',
            'duree_heures' => 'required|integer|min:1|max:4',
            'nombres_joueurs' => 'required|integer|min:1|max:10',
        ]);

        $dateDebut = \Carbon\Carbon::parse($validated['date_debut']);
        $dateFin = $dateDebut->copy()->addHours((int) $validated['duree_heures']);

        \App\Models\Reservation::create([
            'user_id' => auth()->id(),
            'id_terrain' => $terrain->id_terrain,
            'statut' => 'Validée',
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
        ]);

        return redirect()->route('compte.index')->with('success', 'Votre réservation de terrain a été enregistrée avec succès.');
    }
}
