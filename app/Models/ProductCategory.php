<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'name', 'status', 'image'];
    // Boot method to handle model events
    protected static function boot()
    {
        parent::boot();

        // Automatically generate a unique slug when creating a product category
        static::creating(function ($product_category) {
            $product_category->slug = static::generateUniqueSlug();
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
        return $this->hasMany(Product::class, 'category_id');
    }
    //Relationship to sub categories
    public function subCategories()
    {
        return $this->hasMany(ProductSubCategory::class, 'product_categories_id');
    }
}
