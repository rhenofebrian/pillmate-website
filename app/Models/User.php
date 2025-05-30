<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;

    protected $fillable = ['email', 'phone_number', 'password', 'username'];

    protected $hidden = ['password'];

}


