<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terrain extends Model
{
    use HasFactory;

    // Définition de la clé primaire si elle n'est pas "id"
    protected $primaryKey = 'id_terrain';

    protected $fillable = ['nom', 'type_sol', 'image'];

    /**
     * Relation avec les réservations
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_terrain', 'id_terrain');
    }

    /**
     * FIX : La méthode réclamée par ta vue pour le planning
     * Elle transforme les réservations en JSON pour Flatpickr.
     */
    public function getBookedSlotsJson()
    {
        return $this->reservations()
            ->where('date_fin', '>=', now()) // On ne prend que le futur ou l'actuel
            ->get(['date_debut', 'date_fin'])
            ->map(function ($res) {
                return [
                    // On formate les dates en chaînes de caractères pour le JS
                    'from' => $res->date_debut->format('Y-m-d H:i'),
                    'to' => $res->date_fin->format('Y-m-d H:i')
                ];
            })->toJson();
    }
}