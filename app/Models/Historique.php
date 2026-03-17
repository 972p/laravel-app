<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Emprunt;

class Historique extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_log';

    protected $fillable = ['action', 'date_action', 'id_emprunt'];

    public function emprunt()
    {
        return $this->belongsTo(Emprunt::class, 'id_emprunt', 'id_emprunt');
    }
}
