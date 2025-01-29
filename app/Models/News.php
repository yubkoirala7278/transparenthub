<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;
    protected $fillable = ['slug', 'news_categories_id','news_sources_id','title','description','image','rss','status','views','trending_news'];
    // Boot method to handle model events
    protected static function boot()
    {
        parent::boot();

        // Automatically generate a unique slug when creating a news
        static::creating(function ($news) {
            $news->slug = static::generateUniqueSlug();
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
    /**
     *
     * relationship
     * 
     */
    public function news_categories(){
        return $this->belongsTo(NewsCategory::class);
    }
    public function news_sources(){
        return $this->belongsTo(NewsSource::class);
    }
}
