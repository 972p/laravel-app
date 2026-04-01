<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Models\ShoeReservation;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Fetch shoe reservations
        $shoeReservations = ShoeReservation::where('user_id', $user->id)
            ->with('shoe')
            ->orderBy('start_date', 'desc')
            ->get();
            
        // Fetch terrain reservations (original functionality)
        $terrainReservations = \App\Models\Reservation::where('user_id', $user->id)
            ->with('terrain')
            ->orderBy('date_debut', 'desc')
            ->get();
            
        return view('chaussures.reservations', compact('shoeReservations', 'terrainReservations'));
    }

    /**
     * Store a new shoe reservation.
     * 
     * @param StoreReservationRequest $request
     * @return JsonResponse
     */
    public function store(StoreReservationRequest $request): JsonResponse
    {
        $reservation = ShoeReservation::create([
            'shoe_id'    => $request->shoe_id,
            'user_id'    => Auth::id(), 
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
        ]);

        return response()->json([
            'message'     => 'Réservation créée avec succès !',
            'reservation' => $reservation,
        ], 201);
    }

    public function destroy($id)
    {
        // Try finding in ShoeReservations first
        $shoeRes = ShoeReservation::find($id);
        if ($shoeRes) {
            if ($shoeRes->user_id !== Auth::id() && !Auth::user()->is_admin) {
                abort(403);
            }
            $shoeRes->delete();
            return back()->with('success', 'Réservation de chaussures annulée.');
        }

        // Try finding in terrain Reservations (original model)
        $terrainRes = \App\Models\Reservation::find($id);
        if ($terrainRes) {
            if ($terrainRes->user_id !== Auth::id() && !Auth::user()->is_admin) {
                abort(403);
            }
            $terrainRes->delete();
            return back()->with('success', 'Réservation de terrain annulée.');
        }

        abort(404, 'Réservation non trouvée.');
    }
}
