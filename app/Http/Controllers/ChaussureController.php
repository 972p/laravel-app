<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chaussure;
use App\Models\Emprunt;
use App\Models\Historique;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class ChaussureController extends Controller
{
    /**
     * Liste des chaussures avec filtres cumulatifs (menus déroulants)
     */
    public function index(Request $request)
    {
        // 1. Initialisation de la requête avec les relations
        // On charge 'emprunts' pour pouvoir calculer les dates d'indisponibilité en JS
        $query = Chaussure::with(['tags', 'emprunts']);

        // 2. Application des filtres (Menus déroulants)
        if ($request->filled('brand')) {
            $query->where('marque', $request->brand);
        }

        if ($request->filled('size')) {
            $query->where('pointure', $request->size);
        }

        if ($request->filled('condition')) {
            $query->where('etat', $request->condition);
        }

        if ($request->filled('tag')) {
            $query->withTag($request->tag);
        }

        // 3. Recherche globale par REGEX (Flexible)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('modele', 'REGEXP', $request->search)
                    ->orWhere('marque', 'REGEXP', $request->search);
            });
        }

        // 3b. Filtre global de date de disponibilité
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = $request->start_date;
            $end = $request->end_date;
            $query->whereDoesntHave('emprunts', function ($q) use ($start, $end) {
                $q->where('date_debut', '<', $end)
                  ->where('date_expiration', '>', $start);
            });
        }

        // 4. Récupération des résultats
        $chaussures = $query->get();

        // 5. Récupération des données pour alimenter les MENUS DÉROULANTS
        // On récupère uniquement les valeurs existantes en BDD pour éviter les filtres vides
        $brands = Chaussure::distinct()->pluck('marque')->filter()->sort();
        $sizes = Chaussure::distinct()->pluck('pointure')->filter()->sort();
        $conditions = Chaussure::distinct()->pluck('etat')->filter()->sort();
        $tags = Tag::all();

        return view('chaussures.index', compact(
            'chaussures',
            'brands',
            'sizes',
            'conditions',
            'tags'
        ));
    }

    /**
     * Logique de réservation (Emprunt)
     */
    public function emprunter(Request $request, $id)
    {
        // Validation stricte des dates
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ], [
            'start_date.required' => 'Veuillez sélectionner une période sur le calendrier.',
            'end_date.after' => 'La date de fin doit être après la date de début.',
        ]);

        $chaussure = Chaussure::findOrFail($id);

        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Connexion requise pour réserver.');
        }

        // Vérification finale de disponibilité (Sécurité Backend)
        if (!$chaussure->isAvailable($request->start_date, $request->end_date)) {
            return back()->withErrors(['error' => 'Désolé, ce créneau vient d\'être pris.']);
        }

        // Création de la réservation
        $emprunt = Emprunt::create([
            'user_id' => Auth::id(),
            'id_chaussure' => $chaussure->id_chaussure,
            'date_debut' => $request->start_date,
            'date_expiration' => $request->end_date, // On mappe end_date sur date_expiration
            'statut' => 'En cours',
        ]);

        // Historisation
        Historique::create([
            'action' => 'EMPRUNT',
            'date_action' => now(),
            'id_emprunt' => $emprunt->id_emprunt,
        ]);

        return redirect()->route('compte.index')->with('success', 'Votre réservation est confirmée !');
    }
}