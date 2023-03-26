<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    public function tests()
    {
        return $this->belongsToMany(Test::class,'test_elements','element_id','test_id');
    }

    public function values()
    {
        if($this->is_value)
        {
            return $this->hasMany(ElementValueRange::class,'element_id','id');
        }
        else if($this->is_exist)
        {
            return $this->hasMany(ElementExistValue::class,'element_id','id');
        }
        else if($this->is_category)
        {
            return $this->hasMany(CategoryElement::class,'category_id','id');
        }
    }
}
