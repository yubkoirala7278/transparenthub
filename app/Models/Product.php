<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'name', 'description', 'price', 'compare_price', 'feature_image', 'sku', 'category_id', 'sub_category_id', 'brand_id', 'color_id', 'is_featured', 'track_qty', 'qty', 'status', 'shipping_returns'];
    // Boot method to handle model events
    protected static function boot()
    {
        parent::boot();

        // Automatically generate a unique slug when creating a product
        static::creating(function ($product) {
            $product->slug = static::generateUniqueSlug();
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
    // use slug instead of id
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relationship with Product Image model
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    // Relationship to Category
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    // Relationship to SubCategory
    public function subCategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'sub_category_id');
    }

    // Relationship to Brand
    public function brand()
    {
        return $this->belongsTo(ProductBrand::class, 'brand_id');
    }

    // Relationship to Color
    public function colors()
    {
        return $this->belongsToMany(ProductColor::class, 'product_color_product', 'product_id', 'color_id');
    }

     // Relationship to size
     public function sizes()
     {
         return $this->belongsToMany(ProductSize::class, 'product_size_product', 'product_id', 'size_id');
     }
}
