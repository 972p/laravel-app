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

        // Check for overlaps
        $overlap = \App\Models\Reservation::where('id_terrain', $terrain->id_terrain)
            ->where(function ($query) use ($dateDebut, $dateFin) {
                $query->where(function ($q) use ($dateDebut, $dateFin) {
                    $q->where('date_debut', '>=', $dateDebut)
                      ->where('date_debut', '<', $dateFin);
                })
                ->orWhere(function ($q) use ($dateDebut, $dateFin) {
                    $q->where('date_fin', '>', $dateDebut)
                      ->where('date_fin', '<=', $dateFin);
                })
                ->orWhere(function ($q) use ($dateDebut, $dateFin) {
                    $q->where('date_debut', '<=', $dateDebut)
                      ->where('date_fin', '>=', $dateFin);
                });
            })
            ->exists();

        if ($overlap) {
            return back()->withErrors(['date_debut' => 'Ce créneau est déjà réservé pour ce terrain.'])->withInput();
        }

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
