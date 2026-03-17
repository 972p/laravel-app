<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SessionStat;
use App\Models\Terrain;
use Illuminate\Support\Facades\Auth;

class StatistiqueController extends Controller
{
    public function simuler()
    {
        $user = Auth::user();
        $terrain = Terrain::inRandomOrder()->first();

        if (!$terrain) {
            return back()->with('error', 'Aucun terrain disponible pour la simulation.');
        }

        $raquetteTentes = rand(5, 20);
        $raquetteReussis = rand((int)($raquetteTentes * 0.4), (int)($raquetteTentes * 0.7));

        $midTentes = rand(2, 15);
        $midReussis = rand((int)($midTentes * 0.3), (int)($midTentes * 0.5));

        $troisPtsTentes = rand(5, 15);
        $troisPtsReussis = rand((int)($troisPtsTentes * 0.25), (int)($troisPtsTentes * 0.45));

        SessionStat::create([
            'user_id' => $user->id,
            'id_terrain' => $terrain->id_terrain,
            'date_session' => now(),
            'raquette_tentes' => $raquetteTentes,
            'raquette_reussis' => $raquetteReussis,
            'mid_tentes' => $midTentes,
            'mid_reussis' => $midReussis,
            'trois_pts_tentes' => $troisPtsTentes,
            'trois_pts_reussis' => $troisPtsReussis,
            'tirs_tentes' => $raquetteTentes + $midTentes + $troisPtsTentes,
            'tirs_reussis' => $raquetteReussis + $midReussis + $troisPtsReussis,
        ]);

        return redirect()->route('compte.index')->with('success', 'Session de tir simulée avec succès.');
    }
}
