<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Favorite;
use App\Models\AdvertisementImage;

class Advertisement extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'category',
        'location',
        'image',
        'status',
        'rejection_reason',
    ];

    /**
     * Advertisement belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Advertisement has many favorites.
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Advertisement has many additional images.
     */
    public function images(): HasMany
    {
        return $this->hasMany(AdvertisementImage::class)
            ->orderBy('sort_order', 'asc');
    }
}
