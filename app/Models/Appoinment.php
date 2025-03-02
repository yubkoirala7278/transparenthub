<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Appoinment extends Model
{
    use HasFactory;
    protected $fillable=['slug','user_id','professional_id','schedule_id','visit_reason','first_name','last_name','phone_number','email_address'];
     // Boot method to handle model events
     protected static function boot()
     {
         parent::boot();
 
         // Automatically generate a unique slug when creating a appoinment
         static::creating(function ($appoinment) {
             $appoinment->slug = static::generateUniqueSlug();
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
    //  Relationship with schedule
    public function schedule(){
        return $this->belongsTo(ProfessionalSchedule::class,'schedule_id');
    }
}
