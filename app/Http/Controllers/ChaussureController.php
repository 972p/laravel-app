<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chaussure;
use App\Models\Emprunt;
use Illuminate\Support\Facades\Auth;

class ChaussureController extends Controller
{
    public function index()
    {
        $chaussures = Chaussure::all();
        return view('chaussures.index', compact('chaussures'));
    }

    public function emprunter(Request $request, $id)
    {
        $chaussure = Chaussure::findOrFail($id);
        
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Vous devez être connecté pour emprunter.');
        }

        // Check if the shoe is already borrowed (and not yet returned)
        $isBorrowed = Emprunt::where('id_chaussure', $chaussure->id_chaussure)
            ->whereNull('date_retour')
            ->exists();

        if ($isBorrowed) {
            return back()->withErrors(['error' => 'Cette paire est déjà empruntée par un autre utilisateur.']);
        }

        $emprunt = Emprunt::create([
            'user_id' => Auth::id(),
            'id_chaussure' => $chaussure->id_chaussure,
            'date_debut' => now(),
            'date_expiration' => now()->addDays(2), // borrow for 2 days
            'statut' => 'En cours',
        ]);

        \App\Models\Historique::create([
            'action' => 'EMPRUNT',
            'date_action' => now(),
            'id_emprunt' => $emprunt->id_emprunt,
        ]);

        return redirect()->route('compte.index')->with('success', 'Chaussures empruntées avec succès.');
    }
}
