<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function chaussures(): BelongsToMany
    {
        // On précise bien 'Chaussure::class' et le nom de la table pivot 'shoe_tag'
        return $this->belongsToMany(Chaussure::class, 'shoe_tag', 'tag_id', 'shoe_id');
    }
}