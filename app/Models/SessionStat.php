<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionStat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'id_terrain', 'date_session',
        'tirs_tentes', 'tirs_reussis',
        'raquette_tentes', 'raquette_reussis',
        'mid_tentes', 'mid_reussis',
        'trois_pts_tentes', 'trois_pts_reussis'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function terrain()
    {
        return $this->belongsTo(Terrain::class, 'id_terrain', 'id_terrain');
    }
}
