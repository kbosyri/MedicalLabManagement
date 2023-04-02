<?php

namespace App\Models;

use App\Http\Resources\CategoryElementExistValueResource;
use App\Http\Resources\CategoryElementValueResource;
use App\Models\Elements\CategoryElementExistValue;
use App\Models\Elements\CategoryElementValueRange;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function GetSubCategoryResource($id)
    {
        $array = [
            'id'=>$this->id,
            'name'=>$this->name,
            'arabic_name'=>$this->arabic_name,
            'symbol'=>$this->symbol,
        ];

        $array['values'] = [];

        foreach($this->values() as $value)
        {
            array_push($array['values'],$value->GetResource($id));
        }

        return $array;
    }

    public function GetResource($id)
    {
        $array = [
            'id'=>$this->id,
            'name'=>$this->name,
            'arabic_name'=>$this->arabic_name,
            'symbol'=>$this->symbol,
            'is_value'=>$this->is_value,
            'is_exist'=>$this->is_exist,
        ];
        
        if($this->is_value)
        {
            $array['values'] = CategoryElementValueResource::collection($this->values);
            $query = DB::table('patient_test_values')->select(['value'])
            ->where('category_element_id','=',$this->id)
            ->where('patient_test_id','=',$id)
            ->where('is_category_element','=',true)
            ->get();
            $array['test_value'] = $query['value'];
        }
        else if($this->is_exist)
        {
            $array['values'] = CategoryElementExistValueResource::collection($this->values);
            $query = DB::table('patient_test_values')->select(['value'])
            ->where('category_element_id','=',$this->id)
            ->where('patient_test_id','=',$id)
            ->where('is_category_element','=',true)
            ->get();
            $array['test_value'] = $query['value'];
        }
        
        return $array;
    }
}
