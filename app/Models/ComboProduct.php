<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'discount','expiry_date','product_count','image'
    ];
}
