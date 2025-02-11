<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug',
        'user_id',
        'email',
        'first_name',
        'last_name',
        'phone_number',
        'street_address',
        'city',
        'state',
        'zip',
        'sub_total',
        'shipping_charge',
        'coupon_discount',
        'total_charge',
        'payment_status',
        'status',
        'shipped_date'
    ];
    // Boot method to handle model events
    protected static function boot()
    {
        parent::boot();

        // Automatically generate a unique slug when creating a source
        static::creating(function ($order) {
            $order->slug = static::generateUniqueSlug();
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
    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
