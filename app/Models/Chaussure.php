<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Chaussure extends Model
{
    use HasFactory;

    // Définition de la clé primaire personnalisée
    protected $primaryKey = 'id_chaussure';

    // Champs autorisés pour le remplissage de masse
    protected $fillable = ['marque', 'modele', 'pointure', 'etat', 'image'];

    // --- RELATIONS ---

    /**
     * Relation avec les emprunts (Réservations)
     */
    public function emprunts()
    {
        return $this->hasMany(Emprunt::class, 'id_chaussure', 'id_chaussure');
    }

    /**
     * Relation avec les Tags (Table pivot shoe_tag)
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'shoe_tag', 'shoe_id', 'tag_id');
    }

    // --- LOGIQUE DE DISPONIBILITÉ ---

    /**
     * Récupère les plages de dates déjà réservées.
     * Utilisé par Flatpickr dans la vue pour griser les dates indisponibles.
     */
    public function getBookedDates()
    {
        return $this->emprunts()
            ->where('date_expiration', '>=', now()) // On ignore les réservations passées
            ->get(['date_debut', 'date_expiration'])
            ->map(function ($e) {
                return [
                    'from' => $e->date_debut,
                    'to' => $e->date_expiration
                ];
            });
    }

    /**
     * Vérifie si la chaussure est disponible entre deux dates.
     * Logique de chevauchement : (Début1 < Fin2) ET (Fin1 > Début2)
     */
    public function isAvailable($start, $end)
    {
        return !$this->emprunts()
            ->where(function ($query) use ($start, $end) {
                $query->where('date_debut', '<', $end)
                    ->where('date_expiration', '>', $start);
            })->exists();
    }

    // --- FILTRES (Scopes) ---

    /**
     * Permet de filtrer par nom de Tag (ex: Chaussure::withTag('Nike')->get())
     */
    public function scopeWithTag(Builder $query, $tagName)
    {
        return $query->when($tagName, function ($q) use ($tagName) {
            $q->whereHas('tags', function ($tagQuery) use ($tagName) {
                $tagQuery->where('name', $tagName);
            });
        });
    }
}