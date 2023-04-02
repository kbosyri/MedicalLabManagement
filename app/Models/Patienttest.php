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


    public function test()
    {
        return $this->belongsTo(Test::class,'test_id');
    }


    public function staff()
    {
        return $this->belongsTo(Staff::class,'staff_id');
    }

    public function values()
    {
        return $this->hasMany(PatientTestValue::class,'patient_test_id','id');
    }

    public function GetResource()
    {
        $test = [
            'patient'=>$this->patient(),
            'test'=>$this->test(),
            'staff'=>$this->staff(),
        ];

        return $test;
    }
}
