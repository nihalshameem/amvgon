<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryRating extends Model
{
    use HasFactory;
    protected $fillable = [
        'delivery_id','rating','customer_id','order_id'
    ];
}
