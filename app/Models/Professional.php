<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Professional extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'slug', 'category_id', 'sub_category_id', 'phone_number', 'profile_image', 'bio', 'experience_years', 'location', 'rating'];
    // Boot method to handle model events
    protected static function boot()
    {
        parent::boot();

        // Automatically generate a unique slug when creating a professional 
        static::creating(function ($professional) {
            $professional->slug = static::generateUniqueSlug();
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
    // Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relationship to Category
    public function category()
    {
        return $this->belongsTo(ProfessionalCategory::class, 'category_id');
    }

    // Relationship to SubCategory
    public function subCategory()
    {
        return $this->belongsTo(ProfessionalSubCategory::class, 'sub_category_id');
    }
}
