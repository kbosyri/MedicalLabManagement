<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    public function groups()
    {
        return $this->belongsToMany(TestsGroup::class,'test_group_tests','test_id','tests_group_id');
    }

    public function elements()
    {
        return $this->belongsToMany(Element::class,'test_elements','test_id','element_id');
    }


    public function patienttests()
    {
        return $this->belongsToMany(TestsGroup::class,'test_group_tests','test_id','tests_group_id');
    }

    public function patienttes()
    {
        return $this->hasMany(Patienttest::class,'test_id','test_group_tests','tests_group_id');
    }



    
}
