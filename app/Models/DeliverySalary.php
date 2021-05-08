<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverySalary extends Model
{
    use HasFactory;
    protected $fillable = [
        'delivery_id','order_id','distance','salary','order_total'
    ];
}
