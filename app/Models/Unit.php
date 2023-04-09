<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    public function element()
    {
        if($this->element_id)
        {
            return $this->belongsTo(Element::class,'element_id','id');
        }
        if($this->category_element_id)
        {
            return $this->belongsTo(CategoryElement::class,'category_element_id','id');
        }
    }
}
