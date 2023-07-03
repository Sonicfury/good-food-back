<?php

namespace App\Models;

use App\Models\Traits\hasOffer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Ogrre\Media\Traits\HasMedia;

class Product extends hasOffer
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
        'image',
        'category_id'
    ];

    /**
     * Get the category that owns the comment.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The roles that belong to the user.
     */
    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }
}
