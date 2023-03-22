<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Patient extends Model
{
    use HasFactory,Notifiable,HasApiTokens;
    protected $table = 'patient';

    protected $fillable = ['first_name','father_name','last_name','username','password'];

    protected $hidden = ['password','remember_token'];
}
