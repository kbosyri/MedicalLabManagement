<?php

namespace App\GetTestElements;

use App\Models\Test;

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
}