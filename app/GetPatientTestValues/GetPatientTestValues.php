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
use App\Models\ElementExistValue;
use App\Models\Elements\CategoryElementExistValue;
use App\Models\Elements\CategoryElementValueRange;
use App\Models\ElementValueRange;
use App\Models\Patient;
use App\Models\Patienttest;
use App\Models\Staff;
use App\Models\Test;
use Illuminate\Support\Facades\DB;

class GetPatientTestValues 
{
    public static function GetPatientResource(Patient $patient)
    {
        return [
            'id'=>$patient->id,
            'first_name'=>$patient->First_Name,
            'last_name'=>$patient->Last_Name,
            'father_name'=>$patient->Father_Name,
            'username'=>$patient->username,
            'gender'=>$patient->Gender,
            'date_of_birth'=>$patient->Date_Of_Birth,
            'email'=>$patient->email,
            'phone'=>$patient->phone,
            'is_active'=>$patient->is_active,

        ];
    }

    public static function GetStaffResource(Staff $staff)
    {
        return [
            'id'=>$staff->id,
            'biometric_id'=>$staff->biometric_id,
            'first_name'=>$staff->first_name,
            'father_name'=>$staff->father_name,
            'last_name'=>$staff->last_name,
            'username'=>$staff->username,
            'qualifications'=>$staff->qualifications,
            'email'=>$staff->email,
            'phone'=>$staff->phone,
            'is_admin'=>$staff->is_admin,
            'is_lab_staff'=>$staff->is_lab_staff,
            'is_reception'=>$staff->is_reception,
            'is_active'=>$staff->is_active,
            'is_staff'=>true,
        ];
    }

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
            'patient'=>GetPatientTestValues::GetPatientResource($patient_test->patient),
            'test'=>GetPatientTestValues::GetTestResource($patient_test->test,$patient_test->id),
            'staff'=>GetPatientTestValues::GetStaffResource($patient_test->staff),
        ];

        return $test;
    }
    
    public static function GetElementValueRangeResource(ElementValueRange $range)
    {
        return [
            'id'=>$range->id,
            'gender'=>$range->gender,
            'from_age'=>$range->from_age,
            'to_age'=>$range->to_age,
            'age_unit'=>$range->age_unit,
            'min_value'=>$range->min_value,
            'max_value'=>$range->max_value,
            'value'=>$range->value,
            'unit'=>$range->unit,
            'is_range'=>$range->is_range,
            'is_gender_affected'=>$range->is_gender_affected,
            'is_age_affected'=>$range->is_age_affected,
        ];
    }

    public static function GetElementExistValueResource(ElementExistValue $value)
    {
        return [
            'id'=>$value->id,
            'value'=>$value->value,
            'difference'=>$value->difference,
            'is_difference_affected'=>$value->is_difference_affected,
        ];
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
            $array['values'] = [];
            foreach($element->values as $value)
            {
                GetPatientTestValues::GetElementValueRangeResource($value);
            }
            $query = DB::table('patient_test_values')->select(['value'])
            ->where('element_id','=',$element->id)
            ->where('patient_test_id','=',$id)
            ->where('is_category_element','=',false)
            ->get()[0];
            $array['test_value'] = $query->value;
        }
        else if($element->exist)
        {
            $array['values'] = [];
            foreach($element->values as $value)
            {
                GetPatientTestValues::GetElementExistValueResource($value);
            }
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

    public static function GetCategoryElementValueRangeResource(CategoryElementValueRange $range)
    {
        return [
            'id'=>$range->id,
            'gender'=>$range->gender,
            'from_age'=>$range->from_age,
            'to_age'=>$range->to_age,
            'difference'=>$range->difference,
            'min_value'=>$range->min_value,
            'max_value'=>$range->max_value,
            'value'=>$range->value,
            'unit'=>$range->unit,
            'is_range'=>$range->is_range,
            'is_gender_affected'=>$range->is_gender_affected,
            'is_age_affected'=>$range->is_age_affected,
            'is_difference_affected'=>$range->is_difference_affected,
        ];
    }

    public static function GetCategoryElementExistValueResource(CategoryElementExistValue $value)
    {
        return [
            'id'=>$value->id,
            'value'=>$value->value,
            'difference'=>$value->difference,
            'is_difference_affected'=>$value->is_difference_affected,
        ];
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
            $array['values'] = [];
            foreach($element->values as $value)
            {
                GetPatientTestValues::GetCategoryElementValueRangeResource($value);
            }
            $query = DB::table('patient_test_values')->select(['value'])
            ->where('category_element_id','=',$element->id)
            ->where('patient_test_id','=',$id)
            ->where('is_category_element','=',true)
            ->get()[0];
            $array['test_value'] = $query->value;
        }
        else if($element->is_exist)
        {
            $array['values'] = [];
            foreach($element->values as $value)
            {
                GetPatientTestValues::GetCategoryElementExistValueResource($value);
            }
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