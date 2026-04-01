<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shoe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'brand', 'size', 'image'];

    /**
     * Relationship: A shoe has multiple reservations.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(ShoeReservation::class);
    }

    /**
     * Relationship: A shoe has multiple tags (many-to-many).
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Check if the shoe is available for a given date range.
     * Logic: (existing_start < requested_end) AND (existing_end > requested_start)
     */
    public function isAvailable($start, $end): bool
    {
        return !$this->reservations()
            ->where(function (Builder $query) use ($start, $end) {
                $query->where('start_date', '<', $end)
                    ->where('end_date', '>', $start);
            })
            ->exists();
    }

    /**
     * Query Scope: Filter shoes by tag name via URL parameter.
     */
    public function scopeWithTags(Builder $query, ?string $tagName): Builder
    {
        if (empty($tagName)) {
            return $query;
        }

        return $query->whereHas('tags', function (Builder $q) use ($tagName) {
            $q->where('name', $tagName);
        });
    }
}
