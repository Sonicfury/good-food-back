<?php

namespace App\Models;

use App\Models\Traits\hasOffer;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends HasOffer
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'price'
    ];

    /**
     * The roles that belong to the user.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
