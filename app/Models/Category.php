<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ogrre\Media\Traits\HasMedia;

class Category extends Model
{
    use HasFactory, hasMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
    ];

    /**
     * Get the products for the blog post.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
