<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::orderBy('created_at', 'desc')->get();
        $reservations = \App\Models\Reservation::with(['user', 'terrain'])->orderBy('date_debut', 'desc')->get();
        
        return view('admin.index', compact('users', 'reservations'));
    }

    public function storeTerrain(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type_sol' => 'required|string|max:255',
        ]);

        \App\Models\Terrain::create([
            'nom' => $request->nom,
            'type_sol' => $request->type_sol,
        ]);

        return redirect()->route('admin.index')->with('success', 'Terrain ajouté avec succès.');
    }

    public function storeChaussure(Request $request)
    {
        $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'pointure' => 'required|integer|min:30|max:55',
            'etat' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chaussures', 'public');
        }

        \App\Models\Chaussure::create([
            'marque' => $request->marque,
            'modele' => $request->modele,
            'pointure' => $request->pointure,
            'etat' => $request->etat,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.index')->with('success', 'Paire de chaussures ajoutée avec succès.');
    }
}
