<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id','qty','price','payment_method','payment_status','order_status','delivery','shipping_amount','tax','coupon','total','time_charge','door_no','village','district','pincode','state','country','phone','email','start_time','end_time','delivery_date','latitude','longitude','rating','get_cash'
    ];
}
