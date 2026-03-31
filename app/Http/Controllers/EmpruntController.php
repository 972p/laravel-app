<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Emprunt;

class EmpruntController extends Controller
{
    public function index()
    {
        $emprunts = Emprunt::with(['ballon', 'chaussure', 'user'])
            ->whereNull('date_retour')
            ->get();
        return view('retour.index', compact('emprunts'));
    }

    public function retourner(Request $request, $id)
    {
        $emprunt = Emprunt::findOrFail($id);

        // Ensure user owns this borrow or is admin
        if ($emprunt->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'Accès non autorisé');
        }

        $emprunt->update([
            'date_retour' => now(),
            'statut' => 'Rendu',
        ]);

        \App\Models\Historique::create([
            'action' => 'RETOUR',
            'date_action' => now(),
            'id_emprunt' => $emprunt->id_emprunt,
        ]);

        return redirect()->back()->with('success', 'Équipement retourné avec succès.');
    }
}
