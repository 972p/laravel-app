<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Emprunt;
use App\Models\Historique;

class CompteController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        $empruntsActifs = $user->emprunts()->with(['ballon', 'chaussure'])->whereNull('date_retour')->get();
        $historique = \App\Models\Historique::with(['emprunt.ballon', 'emprunt.chaussure'])->latest('date_action')->take(10)->get();
        $stats = $user->sessionStats()->with('terrain')->latest('date_session')->take(5)->get();
        $reservations = $user->reservations()->with('terrain')->where('date_debut', '>', now())->orderBy('date_debut', 'asc')->get();

        return view('compte.index', compact('empruntsActifs', 'historique', 'stats', 'reservations'));
    }
}
