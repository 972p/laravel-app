<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ballon;

class BallonController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Ballon::with('emprunts');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = $request->start_date;
            $end = $request->end_date;
            $query->whereDoesntHave('emprunts', function ($q) use ($start, $end) {
                $q->where('date_debut', '<', $end)
                  ->where('date_expiration', '>', $start);
            });
        }

        $ballons = $query->get();
        return view('emprunt.index', compact('ballons'));
    }

    public function emprunter(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ], [
            'start_date.required' => 'Veuillez sélectionner une période sur le calendrier.',
            'end_date.after' => 'La date de fin doit être après la date de début.',
        ]);

        $ballon = \App\Models\Ballon::findOrFail($id);
        
        if (!auth()->check()) {
            return redirect()->route('login')->withErrors('Connexion requise pour réserver.');
        }

        if (!$ballon->isAvailable($request->start_date, $request->end_date)) {
            return back()->withErrors(['error' => 'Désolé, ce créneau vient d\'être pris.']);
        }

        $emprunt = \App\Models\Emprunt::create([
            'user_id' => auth()->id(),
            'id_ballon' => $ballon->id_ballon,
            'date_debut' => $request->start_date,
            'date_expiration' => $request->end_date,
            'statut' => 'En cours',
        ]);

        \App\Models\Historique::create([
            'action' => 'EMPRUNT',
            'date_action' => now(),
            'id_emprunt' => $emprunt->id_emprunt,
        ]);

        return redirect()->route('compte.index')->with('success', 'Votre réservation est confirmée !');
    }
}
