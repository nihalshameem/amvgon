<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','image','active','category','description','cost','discount','price','type','stock','excellent_stock','standard_stock','min_qty','standard_min_qty','excellent_min_qty','unit','standard_cost','standard_discount','standard_price','excellent_cost','excellent_discount','excellent_price',
    ];
}
