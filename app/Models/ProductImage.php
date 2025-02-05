<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'product_id', 'image'];
    // Boot method to handle model events
    protected static function boot()
    {
        parent::boot();

        // Automatically generate a unique slug when creating a product images
        static::creating(function ($product_image) {
            $product_image->slug = static::generateUniqueSlug();
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

    // Relationship with Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
