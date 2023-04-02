<?php

namespace App\Models;

use App\Http\Resources\Elements\ElementCategoryElementResource;
use App\Http\Resources\Elements\ElementExistValueResource;
use App\Http\Resources\Elements\ElementSubCategoryResource;
use App\Http\Resources\Elements\ElementValueRangeResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function testvalues()
    {
        return $this->hasMany(PatientTestValue::class,'element_id','id');
    }

    Public function GetResource($id)
    {
        $array = [
            'id'=>$this->id,
            'name'=>$this->name,
            'arabic_name'=>$this->arabic_name,
            'symbol'=>$this->symbol,
            'is_value'=>$this->is_value,
            'is_exist'=>$this->is_exist,
            'is_category'=>$this->is_category,
        ];

        if($this->is_value)
        {
            $array['values'] = ElementValueRangeResource::collection($this->values);
            $query = DB::table('patient_test_values')->select(['value'])
            ->where('element_id','=',$this->id)
            ->where('patient_test_id','=',$id)
            ->where('is_category_element','=',false)
            ->get();
            $array['test_value'] = $query['value'];
        }
        else if($this->exist)
        {
            $array['values'] = ElementExistValueResource::collection($this->values);
            $query = DB::table('patient_test_values')->select(['value'])
            ->where('element_id','=',$this->id)
            ->where('patient_test_id','=',$id)
            ->where('is_category_element','=',false)
            ->get();
            $array['test_value'] = $query['value'];
        }

        else if($this->is_category)
        {
            $array['values'] = [];
            foreach($this->values as $value)
            {
                if($value['is_subcategory'])
                {
                    array_push($array['values'],$value->GetSubCategoryResource($id));
                }
                else
                {
                    array_push($array['values'],$value->GetResource($id));
                }
            }
        }

        return $array;
    }
}
