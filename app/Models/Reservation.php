<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    // Indiquez la table si elle ne suit pas le pluriel automatique
    protected $table = 'reservations';
    // AUTORISER l'enregistrement de ces colonnes
    protected $fillable = [
        'user_id',
        'id_terrain',
        'date_debut',
        'date_fin',
        'statut'
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relation avec le terrain
    public function terrain()
    {
        return $this->belongsTo(Terrain::class, 'id_terrain', 'id_terrain');
    }
}