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
        return $this->hasMany(Patienttest::class,'test_id');
    }


    public function GetResource($id)
    {
        $array = [
            'id'=>$this->id,
            'name'=>$this->name,
            'arabic_name'=>$this->arabic_name,
            'overview'=>$this->overview,
            'preconditions'=>$this->preconditions,
            'symbol'=>$this->symbol,
            'cost'=>$this->cost,
        ];

        $array['elements'] = [];

        foreach($this->elements() as $element)
        {
            array_push($array['elements'],$element->GetResource($id));
        }
        return $array;
    }
    
}
