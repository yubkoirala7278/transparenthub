<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductColor extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'name', 'status'];
    // Boot method to handle model events
    protected static function boot()
    {
        parent::boot();

        // Automatically generate a unique slug when creating a color
        static::creating(function ($product_color) {
            $product_color->slug = static::generateUniqueSlug();
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
        return $this->belongsToMany(Product::class, 'product_color_product', 'color_id', 'product_id');
    }
}
