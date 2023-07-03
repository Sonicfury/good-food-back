<?php

namespace App\Models;

use App\Models\Traits\hasOffer;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Ogrre\Media\Traits\HasMedia;

class Menu extends HasOffer
{
    use HasMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'price',
        'image'
    ];

    /**
     * The roles that belong to the user.
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
