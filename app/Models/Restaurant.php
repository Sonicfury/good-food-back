<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ogrre\Media\Traits\HasMedia;

class Restaurant extends Model
{
    use HasFactory, HasMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'address1',
        'address2',
        'zipCode',
        'city',
        'lat',
        'long',
        'phone',
        'image',
        'disabled_at',
    ];

    /**
     * Get the products for the blog post.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
