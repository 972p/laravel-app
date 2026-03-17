<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Reservation;

class AdminReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['user', 'terrain'])->orderBy('date_debut', 'desc')->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validated = $request->validate([
            'statut' => 'required|string|in:confirmée,annulée,terminée',
        ]);

        $reservation->update($validated);
        return redirect()->route('admin.reservations.index')->with('success', 'Statut de la réservation mis à jour.');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('admin.reservations.index')->with('success', 'Réservation supprimée.');
    }
}
