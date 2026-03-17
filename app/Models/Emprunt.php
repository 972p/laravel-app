<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emprunt extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_emprunt';

    protected $fillable = ['date_debut', 'date_expiration', 'user_id', 'id_ballon', 'id_chaussure'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chaussure()
    {
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
