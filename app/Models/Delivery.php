<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Delivery extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $guard = 'deliver';

    protected $fillable = [
        'name', 'phone', 'password', 'show_password' , 'image','door_no','village','district','pincode','state','country','latitude','longitude','license','rc_book','vehicle_name','vehicle_number','rating','bonus','amount_incentive','order_count'
    ];

    protected $hidden = [
        'password',
    ];
}
