<?php

namespace App\Http\Controllers;

use App\Http\Requests\ElementsUpdateAndDelete\UpdateCategoryContentRequest;
use App\Http\Requests\ElementsUpdateAndDelete\UpdateCategoryElementExistValueRequest;
use App\Http\Requests\ElementsUpdateAndDelete\UpdateCategoryElementRequest;
use App\Http\Requests\ElementsUpdateAndDelete\UpdateCategoryElementValueRangeRequest;
use App\Http\Requests\ElementsUpdateAndDelete\UpdateCategoryRequest;
use App\Http\Requests\ElementsUpdateAndDelete\UpdateElementExistValueRequest;
use App\Http\Requests\ElementsUpdateAndDelete\UpdateElementRequest;
use App\Http\Requests\ElementsUpdateAndDelete\UpdateElementValueRangeRequest;
use App\Http\Requests\ElementsUpdateAndDelete\UpdateSubcategoryContentRequest;
use App\Http\Requests\ElementsUpdateAndDelete\UpdateSubcategoryRequest;
use App\Http\Resources\CategoryElementExistValueResource;
use App\Http\Resources\CategoryElementValueResource;
use App\Http\Resources\Elements\CategoryElementResource;
use App\Http\Resources\Elements\CategoryResource;
use App\Http\Resources\Elements\ElementExistValueResource;
use App\Http\Resources\Elements\ElementResource;
use App\Http\Resources\Elements\ElementValueRangeResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\CategoryElement;
use App\Models\Element;
use App\Models\ElementExistValue;
use App\Models\Elements\CategoryElementExistValue;
use App\Models\Elements\CategoryElementValueRange;
use App\Models\ElementValueRange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ElementsUpdateAndDeleteController extends Controller
{

    //Update Functions
    public function UpdateElementValueRange(UpdateElementValueRangeRequest $request,$id)
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

    public function UpdateCategoryElementValueRange(UpdateCategoryElementValueRangeRequest $request, $id)
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

    public function UpdateElementExistValue(UpdateElementExistValueRequest $request, $id)
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

    public function UpdateCategoryElementExistValue(UpdateCategoryElementExistValueRequest $request, $id)
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

    public function UpdateElement(UpdateElementRequest $request, $id)
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

    public function UpdateCategoryElement(UpdateCategoryElementRequest $request, $id)
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

    public function UpdateCategory(UpdateCategoryRequest $request, $id)
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
            'message'=>'تم التعديل الفئة',
            'subcategory'=>new CategoryResource($element),
        ]);
    }

    public function UpdateSubcategory(UpdateSubcategoryRequest $request, $id)
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
            'message'=>'تم تعديل الفئة الفرعية',
            'subcategory'=>new SubCategoryResource($element),
        ]);
    }

    public function UpdateSubcategoryContent(UpdateSubcategoryContentRequest $request, $id)
    {
        CategoryElement::where('subcategory_id',$id)->update(['subcategory_id'=>null]);
        CategoryElement::whereIn('id',$request->elements)->Update(['subcategory_id'=>$id]);
        
        return response()->json([
            'message'=>'تم تعديل محتوى الفئة الجزئية',
            'subcategory'=>new SubCategoryResource(CategoryElement::find($id)),
        ]);
    }

    public function UpdateCategoryContent(UpdateCategoryContentRequest $request, $id)
    {
        CategoryElement::where('category_id',$id)->update(['category_id'=>null]);
        CategoryElement::whereIn('id',$request->elements)->Update(['category_id'=>$id]);
        
        return response()->json([
            'message'=>'تم تعديل محتوى الفئة',
            'category'=>new CategoryResource(CategoryElement::find($id)),
        ]);
    }

    public function DeleteElementValueRange($id)
    {
        ElementValueRange::find($id)->delete();

        return response()->json([
            'message'=>'تم حذف مجال قيم المؤشر'
        ]);
    }
    
    public function DeleteCategoryElementValueRange($id)
    {
        CategoryElementValueRange::find($id)->delete();

        return response()->json([
            'message'=>'تم حذف مجال قيم المؤشر'
        ]);
    }

    public function DeleteElementExistValue($id)
    {
        ElementExistValue::find($id)->delete();

        return response()->json([
            'message'=>'تم حذف قيمة المؤشر'
        ]);
    }

    public function DeleteCategoryElementExistValue($id)
    {
        CategoryElementExistValue::find($id)->delete();

        return response()->json([
            'message'=>'تم حذف قيمة المؤشر'
        ]);
    }

    public function DeleteCategoryElement($id)
    {
        $element = CategoryElement::find($id);

        foreach($element->values as $value)
        {
            $value->delete();
        }

        $element->delete();

        return response()->json([
            'message'=>'تم حذف المؤشر الجزئي'
        ]);
    }

    public function DeleteElement($id)
    {
        $element = Element::find($id);

        foreach($element->values as $value)
        {
            $value->delete();
        }

        $element->delete();

        return response()->json([
            'message'=>'تم حذف المؤشر'
        ]);
    }

    public function RemoveCategoryElementFromCategory($id)
    {
        $element = CategoryElement::find($id);

        $category = Element::find($element->category_id);

        $element->category_id = null;

        return response()->json([
            'message'=>'تم إزالة المؤشر الجزئي من الفئة',
            'category'=>new CategoryResource($category),
        ]);
    }

    public function RemoveCategoryElementFromSubcategory($id)
    {
        $element = CategoryElement::find($id);

        $subcategory = CategoryElement::find($element->subcategory_id);

        $element->subcategory_id = null;

        return response()->json([
            'message'=>'تم إزالة المؤشر الجزئي من الفئة',
            'category'=>new CategoryResource($subcategory),
        ]);
    }

    public function DeleteCategory($id)
    {
        $category = Element::find($id);
        
        foreach($category->values as $element)
        {
            if($element->is_subcategory)
            {
                foreach($element->values as $categoryelement)
                {
                    foreach($categoryelement->values as $value)
                    {
                        $value->delete();
                    }

                    $categoryelement->delete();
                }
                $element->delete();
            }
            else
            {
                $element->values->delete();
                $element->delete();
            }
        }

        return response()->json([
            'message'=> 'تم حذف الفئة'
        ]);
    }

    public function DeleteSubcategory($id)
    {
        $subcategory = CategoryElement::find($id);

        foreach($subcategory->values as $categoryelement)
        {
            foreach($categoryelement->values as $value)
            {
                $value->delete();
            }

            $categoryelement->delete();
        }

        $subcategory->delete();

        return response()->json([
            'message'=>'تم حذف المجموعة الجزئية'
        ]);
    }
}
