<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use App\Models\Test;
use App\Models\Staff;
class Patienttest extends Model
{
    use HasFactory;
    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }


    public function tests()
    {
        return $this->belongsTo(Test::class,'test_group_tests','test_id','tests_group_id');
    }

    public function test()
    {
        return $this->belongsToMany(Test::class,'test_id','test_group_tests','tests_group_id');
    }


    public function staff()
    {
        return $this->belongsToMany(Staff::class,'staff_id');
    }


}
