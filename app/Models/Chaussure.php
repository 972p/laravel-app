<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chaussure extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_chaussure';

    protected $fillable = ['marque', 'modele', 'pointure', 'etat', 'image'];

    public function emprunts()
    {
        return $this->hasMany(Emprunt::class, 'id_chaussure', 'id_chaussure');
    }
}
