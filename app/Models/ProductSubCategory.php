<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductSubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['slug','product_categories_id','name','status'];
    // Boot method to handle model events
    protected static function boot()
    {
        parent::boot();

        // Automatically generate a unique slug when creating a product sub_category
        static::creating(function ($product_sub_category) {
            $product_sub_category->slug = static::generateUniqueSlug();
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

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_categories_id');
    }
}
