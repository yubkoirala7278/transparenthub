<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProfessionalSubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'professional_categories_id', 'name', 'status'];
    // Boot method to handle model events
    protected static function boot()
    {
        parent::boot();

        // Automatically generate a unique slug when creating a professional sub_category
        static::creating(function ($professional_sub_category) {
            $professional_sub_category->slug = static::generateUniqueSlug();
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
    // Relationship to Category
    public function category()
    {
        return $this->belongsTo(ProfessionalCategory::class, 'professional_categories_id');
    }
    public function getSubcategories($categoryId)
    {
        $subcategories = ProfessionalSubCategory::where('professional_categories_id', $categoryId)->get();
        return response()->json($subcategories);
    }
}
