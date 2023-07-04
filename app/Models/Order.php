<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'state',
        'isTakeaway',
        'total',
        'addresses_id',
        'customer_id',
        'restaurant_id',
        'employee_id'
    ];

    /**
     * Get the category that owns the comment.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the comment.
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * Get the category that owns the comment.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the products for the blog post.
     */
    public function ordereds(): HasMany
    {
        return $this->hasMany(Ordered::class);
    }
}
