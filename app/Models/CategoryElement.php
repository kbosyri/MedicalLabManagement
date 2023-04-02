<?php

namespace App\Models;

use App\Models\Elements\CategoryElementExistValue;
use App\Models\Elements\CategoryElementValueRange;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryElement extends Model
{
    use HasFactory;

    public function category()
    {
        if($this->category_id)
        {
            return $this->belongsTo(Element::class,'category_id','id');
        }
        else if($this->subcategory_id)
        {
            return $this->belongsTo(CategoryElement::class,'subcategory_id','id');
        }
        else
        {
            return null;
        }
    }

    public function values()
    {
        if($this->is_value)
        {
            return $this->hasMany(CategoryElementValueRange::class,'category_element_id','id');
        }
        else if($this->is_exist)
        {
            return $this->hasMany(CategoryElementExistValue::class,'category_element_id','id');
        }
        else if($this->is_subcategory)
        {
            return $this->hasMany(CategoryElement::class,'subcategory_id','id');
        }
    }

    public function testvalues()
    {
        return $this->hasMany(PatientTestValue::class,'category_element_id','id');
    }
}
