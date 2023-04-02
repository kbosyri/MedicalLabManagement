<?php

namespace App\GetPatientTestValues;

use App\Http\Resources\CategoryElementExistValueResource;
use App\Http\Resources\CategoryElementValueResource;
use App\Http\Resources\Elements\ElementExistValueResource;
use App\Http\Resources\Elements\ElementValueRangeResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\StaffResource;
use App\Models\CategoryElement;
use App\Models\Element;
use App\Models\Patienttest;
use App\Models\Test;
use Illuminate\Support\Facades\DB;

class GetPatientTestValues 
{

    public static function GetTestResource(Test $test,$id)
    {
        error_log("in GetTestResource");
        $array = [
            'id'=>$test->id,
            'name'=>$test->name,
            'arabic_name'=>$test->arabic_name,
            'overview'=>$test->overview,
            'preconditions'=>$test->preconditions,
            'symbol'=>$test->symbol,
            'cost'=>$test->cost,
        ];

        $array['elements'] = [];

        foreach($test->elements as $element)
        {
            array_push($array['elements'],GetPatientTestValues::GetElementResource($element,$id));
        }
        return $array;
    }

    public static function GetPatientTestResource(Patienttest $patient_test)
    {
        error_log("in GetPatientTestResource");
        $test = [
            'patient'=>new PatientResource($patient_test->patient),
            'test'=>GetPatientTestValues::GetTestResource($patient_test->test,$patient_test->id),
            'staff'=>new StaffResource($patient_test->staff),
        ];

        return $test;
    }
    
    Public static function GetElementResource(Element $element, $id)
    {
        error_log("in GetElementResource");
        $array = [
            'id'=>$element->id,
            'name'=>$element->name,
            'arabic_name'=>$element->arabic_name,
            'symbol'=>$element->symbol,
            'is_value'=>$element->is_value,
            'is_exist'=>$element->is_exist,
            'is_category'=>$element->is_category,
        ];

        if($element->is_value)
        {
            $array['values'] = ElementValueRangeResource::collection($element->values);
            $query = DB::table('patient_test_values')->select(['value'])
            ->where('element_id','=',$element->id)
            ->where('patient_test_id','=',$id)
            ->where('is_category_element','=',false)
            ->get()[0];
            $array['test_value'] = $query->value;
        }
        else if($element->exist)
        {
            $array['values'] = ElementExistValueResource::collection($element->values);
            $query = DB::table('patient_test_values')->select(['value'])
            ->where('element_id','=',$element->id)
            ->where('patient_test_id','=',$id)
            ->where('is_category_element','=',false)
            ->get()[0];
            $array['test_value'] = $query->value;
        }

        else if($element->is_category)
        {
            $array['values'] = [];
            foreach($element->values as $value)
            {
                if($value['is_subcategory'])
                {
                    array_push($array['values'],GetPatientTestValues::GetSubCategoryResource($value,$id));
                }
                else
                {
                    array_push($array['values'],GetPatientTestValues::GetCategoryElementResource($value,$id));
                }
            }
        }

        return $array;
    }

    public static function GetSubCategoryResource(CategoryElement $subcategory, $id)
    {
        error_log("in GetSubCategoryResource");
        $array = [
            'id'=>$subcategory->id,
            'name'=>$subcategory->name,
            'arabic_name'=>$subcategory->arabic_name,
            'symbol'=>$subcategory->symbol,
        ];

        $array['values'] = [];

        foreach($subcategory->values as $value)
        {
            array_push($array['values'],GetPatientTestValues::GetCategoryElementResource($value,$id));
        }

        return $array;
    }

    public static function GetCategoryElementResource(CategoryElement $element, $id)
    {
        error_log("in GetCategoryElementResource");
        $array = [
            'id'=>$element->id,
            'name'=>$element->name,
            'arabic_name'=>$element->arabic_name,
            'symbol'=>$element->symbol,
            'is_value'=>$element->is_value,
            'is_exist'=>$element->is_exist,
        ];
        
        if($element->is_value)
        {
            $array['values'] = CategoryElementValueResource::collection($element->values);
            $query = DB::table('patient_test_values')->select(['value'])
            ->where('category_element_id','=',$element->id)
            ->where('patient_test_id','=',$id)
            ->where('is_category_element','=',true)
            ->get()[0];
            $array['test_value'] = $query->value;
        }
        else if($element->is_exist)
        {
            $array['values'] = CategoryElementExistValueResource::collection($element->values);
            $query = DB::table('patient_test_values')->select(['value'])
            ->where('category_element_id','=',$element->id)
            ->where('patient_test_id','=',$id)
            ->where('is_category_element','=',true)
            ->get()[0];
            $array['test_value'] = $query->value;
        }
        
        return $array;
    }
}