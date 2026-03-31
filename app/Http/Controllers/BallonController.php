<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ballon;

class BallonController extends Controller
{
    public function index()
    {
        $ballons = \App\Models\Ballon::all();
        return view('emprunt.index', compact('ballons'));
    }

    public function emprunter(Request $request, $id)
    {
        $ballon = \App\Models\Ballon::findOrFail($id);
        
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors('Vous devez être connecté pour emprunter.');
        }

        // Check availability
        $isBorrowed = \App\Models\Emprunt::where('id_ballon', $id)
            ->whereNull('date_retour')
            ->exists();

        if ($isBorrowed) {
            return back()->withErrors(['error' => 'Ce ballon est déjà emprunté.']);
        }

        $emprunt = \App\Models\Emprunt::create([
            'user_id' => auth()->id(),
            'id_ballon' => $ballon->id_ballon,
            'date_debut' => now(),
            'date_expiration' => now()->addHours(2), // borrow for 2 hours
            'statut' => 'En cours',
        ]);

        \App\Models\Historique::create([
            'action' => 'EMPRUNT',
            'date_action' => now(),
            'id_emprunt' => $emprunt->id_emprunt,
        ]);

        return redirect()->route('compte.index')->with('success', 'Ballon emprunté avec succès.');
    }
}
