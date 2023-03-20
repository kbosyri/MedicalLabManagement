<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementRange extends Model
{
    use HasFactory;

    public function element()
    {
        return $this->belongsTo(Element::class,'element_id','id');
    }
}
