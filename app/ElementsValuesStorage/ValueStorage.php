<?php

namespace App\ElementsValuesStorage;

use App\Models\ElementExistValue;
use App\Models\Elements\CategoryElementExistValue;
use App\Models\Elements\CategoryElementValueRange;
use App\Models\ElementValueRange;

class ValueStorage
{
    public static function SetElementValueRanges($element_id, array $values)
    {
        foreach($values as $value)
        {
            $new_range = new ElementValueRange();

            $new_range->element_id = $element_id;
            $new_range->gender = $value['gender'];
            $new_range->from_age = $value['from_age'];
            $new_range->to_age = $value['to_age'];
            $new_range->age_unit = $value['age_unit'];
            $new_range->min_value = $value['min_value'];
            $new_range->max_value = $value['max_value'];
            $new_range->value = $value['value'];
            $new_range->unit = $value['unit'];
            $new_range->is_range = $value['is_range'];
            $new_range->is_gender_affected = $value['is_gender_affected'];
            $new_range->is_age_affected = $value['is_age_affected'];

            $new_range->save();

        }
    }

    public static function SetElementExistValues($element_id, array $values)
    {
        foreach($values as $value)
        {
            $new_value = new ElementExistValue();

            $new_value->element_id = $element_id;
            $new_value->value = $value['value'];
            $new_value->difference = $value['difference'];
            $new_value->is_difference_affected = $value['is_difference_affected'];

            $new_value->save();
        }
    }

    public static function SetCategoryElementValueRanges($category_element_id, array $values)
    {
        foreach($values as $value)
        {
            $new_range = new CategoryElementValueRange();

            $new_range->category_element_id = $category_element_id;
            $new_range->gender = $value['gender'];
            $new_range->from_age = $value['from_age'];
            $new_range->to_age = $value['to_age'];
            $new_range->age_unit = $value['age_unit'];
            $new_range->difference = $value['difference'];
            $new_range->min_value = $value['min_value'];
            $new_range->max_value = $value['max_value'];
            $new_range->value = $value['value'];
            $new_range->unit = $value['unit'];
            $new_range->is_range = $value['is_range'];
            $new_range->is_gender_affected = $value['is_gender_affected'];
            $new_range->is_age_affected = $value['is_age_affected'];
            $new_range->is_difference_affected = $value['is_difference_affected'];

            $new_range->save();
        }
    }

    public static function SetCategoryElementsExistValues($category_element_id, array $values)
    {
        foreach($values as $value)
        {
            $new_value = new CategoryElementExistValue();

            $new_value->category_element_id = $category_element_id;
            $new_value->value = $value['value'];
            $new_value->difference = $value['difference'];
            $new_value->is_difference_affected = $value['is_difference_affected'];

            $new_value->save();
        }
    }

}