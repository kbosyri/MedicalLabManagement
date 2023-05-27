<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Staff extends Authenticatable
{
    use HasFactory,Notifiable,HasApiTokens;

    protected $table = 'staff';

    protected $fillable = ['first_name','father_name','last_name','username','password'];

    protected $hidden = ['password','remember_token'];


    public function patienttests()
    {
        return $this->hasMany(Patienttest::class,'staff_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id','id');
    }

}



