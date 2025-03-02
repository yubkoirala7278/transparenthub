<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PalikaQnA extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'palika_id', 'question', 'answer', 'status'];
    // Boot method to handle model events
    protected static function boot()
    {
        parent::boot();

        // Automatically generate a unique slug when creating a question_answer
        static::creating(function ($question_answer) {
            $question_answer->slug = static::generateUniqueSlug();
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
     // Relationship to palika
     public function palika()
     {
         return $this->belongsTo(Palika::class);
     }
}
