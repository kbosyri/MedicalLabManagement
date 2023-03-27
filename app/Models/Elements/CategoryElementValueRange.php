<?php

namespace App\Models\Elements;

use App\Models\CategoryElement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryElementValueRange extends Model
{
    use HasFactory;

    public function element()
    {
        return $this->belongsTo(CategoryElement::class,'category_element_id','id');
    }
}
