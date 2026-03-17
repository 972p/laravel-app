<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terrain extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_terrain';

    protected $fillable = ['nom', 'type_sol'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'id_terrain', 'id_terrain');
    }
}
