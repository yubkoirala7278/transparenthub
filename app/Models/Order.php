<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
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
    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }
}
