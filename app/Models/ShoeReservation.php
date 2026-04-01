<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShoeReservation extends Model
{
    use HasFactory;

    protected $fillable = ['shoe_id', 'user_id', 'start_date', 'end_date'];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Relationship: A reservation belongs to a shoe.
     */
    public function shoe(): BelongsTo
    {
        return $this->belongsTo(Shoe::class);
    }

    /**
     * Relationship: A reservation belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
