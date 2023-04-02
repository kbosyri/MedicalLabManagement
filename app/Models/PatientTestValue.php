<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientTestValue extends Model
{
    use HasFactory;

    public function test()
    {
        return $this->belongsTo(Patienttest::class,'patient_test_id','id');
    }

    public function element()
    {
        if($this->is_category_element)
        {
            return $this->belongsTo(CategoryElement::class,'category_element_id','id');
        }
        else
        {
            return $this->belongsTo(Element::class,'element_id','id');
        }
    }
}
