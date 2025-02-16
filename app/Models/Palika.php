<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Palika extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'district_id', 'name', 'population', 'total_area', 'status'];
    // Boot method to handle model events
    protected static function boot()
    {
        parent::boot();

        // Automatically generate a unique slug when creating a palika
        static::creating(function ($palika) {
            $palika->slug = static::generateUniqueSlug();
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
    // Relationship to district
    public function district()
    {
        return $this->belongsTo(District::class);
    }
     // Relationship to palika qna
    public function palikaQnAs()
    {
        return $this->hasMany(PalikaQnA::class);
    }
}
