<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Offer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'percent',
        'product_id'
    ];

    /**
     * Get the parent commentable model (post or video).
     */
    public function offerable(): MorphTo
    {
        return $this->morphTo();
    }
}
