<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emprunt extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_emprunt';

    protected $fillable = [
        'date_debut',
        'date_expiration',
        'user_id',
        'id_ballon',
        'id_chaussure',
        'date_retour',
        'statut'
    ];

    /**
     * Correction : On indique à Laravel de transformer ces colonnes en objets Carbon (Dates)
     */
    protected $casts = [
        'date_debut' => 'datetime',
        'date_expiration' => 'datetime',
        'date_retour' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chaussure()
    {
        // On précise bien les clés étrangères car tu n'utilises pas le standard 'chaussure_id'
        return $this->belongsTo(Chaussure::class, 'id_chaussure', 'id_chaussure');
    }

    public function ballon()
    {
        return $this->belongsTo(Ballon::class, 'id_ballon', 'id_ballon');
    }

    public function historiques()
    {
        return $this->hasMany(Historique::class, 'id_emprunt', 'id_emprunt');
    }
}