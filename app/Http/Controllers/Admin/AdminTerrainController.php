<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Terrain;

class AdminTerrainController extends Controller
{
    public function index()
    {
        $terrains = Terrain::all();
        return view('admin.terrains.index', compact('terrains'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type_sol' => 'required|string|max:255',
        ]);

        Terrain::create($request->only(['nom', 'type_sol']));
        return redirect()->route('admin.terrains.index')->with('success', 'Terrain ajouté avec succès.');
    }

    public function update(Request $request, Terrain $terrain)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'type_sol' => 'required|string|max:255',
        ]);

        $terrain->update($request->only(['nom', 'type_sol']));
        return redirect()->route('admin.terrains.index')->with('success', 'Terrain mis à jour.');
    }

    public function destroy(Terrain $terrain)
    {
        $terrain->delete();
        return redirect()->route('admin.terrains.index')->with('success', 'Terrain supprimé de la base de données.');
    }
}
