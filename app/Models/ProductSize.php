<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductSize extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'name', 'status'];
    // Boot method to handle model events
    protected static function boot()
    {
        parent::boot();

        // Automatically generate a unique slug when creating a product size
        static::creating(function ($product_size) {
            $product_size->slug = static::generateUniqueSlug();
        });
    }

    /**
     * Generate an 8-character unique slug
     *
     * @return string
     */
    private static function generateUniqueSlug()
    {
        do {
            $slug = Str::random(8); // Generate an 8-character random string
        } while (self::where('slug', $slug)->exists()); // Ensure it's unique

        return $slug;
    }
    // Relationship to Products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_size_product', 'size_id', 'product_id');
    }
}
