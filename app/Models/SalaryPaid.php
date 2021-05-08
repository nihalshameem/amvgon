<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryPaid extends Model
{
    use HasFactory;
    protected $fillable = [
        'delivery_id','order_count','distance','delivery_charge','weekly_incentive','order_incentive','amount_incentive','bonus','total_amount','start_date'
    ];
}
