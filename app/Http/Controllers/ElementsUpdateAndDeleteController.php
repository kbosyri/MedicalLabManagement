<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryElementExistValueResource;
use App\Http\Resources\CategoryElementValueResource;
use App\Http\Resources\Elements\CategoryElementResource;
use App\Http\Resources\Elements\ElementExistValueResource;
use App\Http\Resources\Elements\ElementResource;
use App\Http\Resources\Elements\ElementValueRangeResource;
use App\Models\CategoryElement;
use App\Models\Element;
use App\Models\ElementExistValue;
use App\Models\Elements\CategoryElementExistValue;
use App\Models\Elements\CategoryElementValueRange;
use App\Models\ElementValueRange;
use Illuminate\Http\Request;

class ElementsUpdateAndDeleteController extends Controller
{
    public function UpdateElementValueRange(Request $request,$id)
    {
        $range = ElementValueRange::find($id);

        $range->gender = $request->gender;
        $range->from_age = $request->from_age;
        $range->to_age = $request->to_age;
        $range->age_unit = $request->age_unit;
        $range->min_value = $request->min_value;
        $range->max_value = $request->max_value;
        $range->value = $request->value;
        $range->unit = $request->unit;
        $range->is_range = $request->is_range;
        $range->is_gender_affected = $request->is_gender_affected;
        $range->is_age_affected = $request->is_age_affected;

        $range->save();

        return response()->json([
            'message'=>'تم تعديل مجال القيم',
            'range'=>new ElementValueRangeResource($range),
        ]);
    }

    public function UpdateCategoryElementValueRange(Request $request, $id)
    {
        $range = CategoryElementValueRange::find($id);

        $range->gender = $request->gender;
        $range->from_age = $request->from_age;
        $range->to_age = $request->to_age;
        $range->age_unit = $request->age_unit;
        $range->difference = $request->difference;
        $range->min_value = $request->min_value;
        $range->max_value = $request->max_value;
        $range->value = $request->value;
        $range->unit = $request->unit;
        $range->is_range = $request->is_range;
        $range->is_gender_affected = $request->is_gender_affected;
        $range->is_age_affected = $request->is_age_affected;
        $range->is_difference_affected = $request->is_difference_affected;

        $range->save();

        return response()->json([
            'message'=>'تم تعديل مجال القيم',
            'range'=>new CategoryElementValueResource($range),
        ]);
    }

    public function UpdateElementExistValue(Request $request, $id)
    {
        $value = ElementExistValue::find($id);

        $value->value = $request->value;
        $value->difference = $request->difference;
        $value->is_difference_affected = $request->is_difference_affected;
        $value->save();

        return response()->json([
            'message'=>"تم تعديل القيمة",
            'element'=>new ElementExistValueResource($value),
        ]);
    }

    public function UpdateCategoryElementExistValue(Request $request, $id)
    {
        $value = CategoryElementExistValue::find($id);

        $value->value = $request->value;
        $value->difference = $request->difference;
        $value->is_difference_affected = $request->is_difference_affected;
        $value->save();

        return response()->json([
            'message'=>"تم تعديل القيمة",
            'element'=>new CategoryElementExistValueResource($value),
        ]);
    }

    public function UpdateElement(Request $request, $id)
    {
        $element = Element::find($id);

        $element->name = $request->name;
        $element->arabic_name = $request->arabic_name;
        $element->symbol = $request->symbol;
        $element->is_value = $request->is_value;
        $element->is_exist = $request->is_exist;
        $element->is_category = $request->is_category;

        $element->save();

        return response()->json([
            'message'=>'تم تعديل المؤشر',
            'element'=>new ElementResource($element),
        ]);
    }

    public function UpdateCategoryElement(Request $request, $id)
    {
        $element = CategoryElement::find($id);

        $element->name = $request->name;
        $element->arabic_name = $request->arabic_name;
        $element->symbol = $request->symbol;

        $element->is_value = $request->is_value;
        $element->is_exist = $request->is_exist;
        $element->is_subcategory = $request->is_subcategory;

        $element->save();

        return response()->json([
            'message'=>'تم تعديل المؤشر الجزئي',
            'element'=>new CategoryElementResource($element),
        ]);
    }
}
