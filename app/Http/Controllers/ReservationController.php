<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['terrain', 'user'])->get();
        return view('reservations.index', compact('reservations'));
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        
        // Ensure user owns this reservation or is admin
        if ($reservation->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'Accès non autorisé');
        }

        $reservation->delete();

        return redirect()->back()->with('success', 'Réservation annulée avec succès.');
    }
}
