<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Emprunt;

class Ballon extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_ballon';

    protected $fillable = ['marque', 'taille', 'etat'];

    public function emprunts()
    {
        return $this->hasMany(Emprunt::class, 'id_ballon', 'id_ballon');
    }
}
