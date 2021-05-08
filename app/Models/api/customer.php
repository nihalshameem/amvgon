<?php

namespace App\Models\api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class customer extends Authenticatable
{
    use HasFactory, Notifiable;

    public $table = 'customers';

    protected $guard = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','phone', 'email', 'password',
    ];

    protected $hidden = [
        'password'
    ];

    protected $rules = [
        'email' => 'required|email|unique:customers',
        'phone' => 'required|digits:10|unique:customers',
    ];
}
