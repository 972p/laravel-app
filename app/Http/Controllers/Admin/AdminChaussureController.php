<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Chaussure;
use Illuminate\Support\Facades\Storage;

class AdminChaussureController extends Controller
{
    public function index()
    {
        $chaussures = Chaussure::orderBy('created_at', 'desc')->get();
        return view('admin.chaussures.index', compact('chaussures'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'pointure' => 'required|integer|min:30|max:55',
            'etat' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chaussures', 'public');
            $validated['image'] = $imagePath;
        }

        Chaussure::create($validated);
        return redirect()->route('admin.chaussures.index')->with('success', 'Paire de chaussures ajoutée avec succès.');
    }

    public function update(Request $request, Chaussure $chaussure)
    {
        $validated = $request->validate([
            'marque' => 'required|string|max:255',
            'modele' => 'required|string|max:255',
            'pointure' => 'required|integer|min:30|max:55',
            'etat' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($chaussure->image && Storage::disk('public')->exists($chaussure->image)) {
                Storage::disk('public')->delete($chaussure->image);
            }
            $imagePath = $request->file('image')->store('chaussures', 'public');
            $validated['image'] = $imagePath;
        }

        $chaussure->update($validated);
        return redirect()->route('admin.chaussures.index')->with('success', 'Paire de chaussures mise à jour.');
    }

    public function destroy(Chaussure $chaussure)
    {
        if ($chaussure->image && Storage::disk('public')->exists($chaussure->image)) {
            Storage::disk('public')->delete($chaussure->image);
        }
        $chaussure->delete();
        return redirect()->route('admin.chaussures.index')->with('success', 'Paire de chaussures supprimée de la base de données.');
    }
}
