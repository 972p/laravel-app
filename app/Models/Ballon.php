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

    public function getBookedDates()
    {
        return $this->emprunts()
            ->where('date_expiration', '>=', now())
            ->get(['date_debut', 'date_expiration'])
            ->map(function ($e) {
                return [
                    'from' => $e->date_debut,
                    'to' => $e->date_expiration
                ];
            });
    }

    public function isAvailable($start, $end)
    {
        return !$this->emprunts()
            ->where(function ($query) use ($start, $end) {
                $query->where('date_debut', '<', $end)
                    ->where('date_expiration', '>', $start);
            })->exists();
    }
}
