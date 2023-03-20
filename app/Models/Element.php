<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    public function ranges()
    {
        return $this->hasMany(ElementRange::class,'element_id','id');
    }

    public function tests()
    {
        return $this->belongsToMany(Test::class,'test_elements','element_id','test_id');
    }

    
}
