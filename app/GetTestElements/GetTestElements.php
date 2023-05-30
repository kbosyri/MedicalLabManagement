<?php

namespace App\GetTestElements;

use App\Models\Test;
use Illuminate\Support\Facades\DB;

class GetTestElements 
{
    public static function GetTestElements(Test $test)
    {
        $elements = [];
        
        foreach($test->elements as $element)
        {
            if($element->is_value || $element->is_exist)
            {
                $info = [];
                $units = [];
                foreach($element->units as $unit)
                {
                    array_push($units,$unit->unit_name);
                }
                $info['name'] = $element->name;
                $info['element_id'] = $element->id;
                $info['units'] = $units;
                $info['is_category_element'] = false;
                array_push($elements,$info);
            }
            else if($element->is_category)
            {
                foreach($element->values as $catelem)
                {
                    if($catelem->is_value || $catelem->is_exist)
                    {
                        $info = [];
                        $units = [];
                        foreach($catelem->units as $unit)
                        {
                            array_push($units,$unit->unit_name);
                        }
                        $info['name'] = $catelem->name;
                        $info['element_id'] = $catelem->id;
                        $info['units'] = $units;
                        $info['is_category_element'] = true;
                        array_push($elements,$info);
                    }
                    else if($catelem->is_subcategory)
                    {
                        foreach($catelem->values as $subcatelem)
                        {
                            $info = [];
                            $units = [];
                            foreach($subcatelem->units as $unit)
                            {
                                array_push($units,$unit->unit_name);
                            }
                            $info['name'] = $subcatelem->name;
                            $info['element_id'] = $subcatelem->id;
                            $info['units'] = $units;
                            $info['is_category_element'] = true;
                            array_push($elements,$info);
                        }
                    }
                }
            }
        }

        return $elements;
    }

    public static function GetTestElementsValues(Test $test,$id)
    {
        $elements = [];
        
        foreach($test->elements as $element)
        {
            if($element->is_value || $element->is_exist)
            {
                $query = DB::table('patient_test_values')->select(['value','unit'])
                ->where('element_id','=',$element->id)
                ->where('patient_test_id','=',$id)
                ->where('is_category_element','=',false)
                ->get()[0];
                $info = [];
                $info['name'] = $element->name;
                $info['element_id'] = $element->id;
                $info['unit'] = $query->unit;
                $info['value'] = $query->value;
                $info['is_category_element'] = false;
                array_push($elements,$info);
            }
            else if($element->is_category)
            {
                foreach($element->values as $catelem)
                {
                    if($catelem->is_value || $catelem->is_exist)
                    {
                        $query = DB::table('patient_test_values')->select(['value','unit'])
                        ->where('category_element_id','=',$catelem->id)
                        ->where('patient_test_id','=',$id)
                        ->where('is_category_element','=',true)
                        ->get()[0];
                        $info = [];
                        $info['name'] = $catelem->name;
                        $info['element_id'] = $catelem->id;
                        $info['unit'] = $query->unit;
                        $info['value'] = $query->value;
                        $info['is_category_element'] = true;
                        array_push($elements,$info);
                    }
                    else if($catelem->is_subcategory)
                    {
                        foreach($catelem->values as $subcatelem)
                        {
                            $query = DB::table('patient_test_values')->select(['value','unit'])
                            ->where('category_element_id','=',$subcatelem->id)
                            ->where('patient_test_id','=',$id)
                            ->where('is_category_element','=',true)
                            ->get()[0];
                            $info = [];
                            $info['name'] = $subcatelem->name;
                            $info['element_id'] = $subcatelem->id;
                            $info['unit'] = $query->unit;
                            $info['value'] = $query->value;
                            $info['is_category_element'] = true;
                            array_push($elements,$info);
                        }
                    }
                }
            }
        }

        return $elements;
    }
}