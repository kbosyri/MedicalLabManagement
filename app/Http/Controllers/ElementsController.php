<?php

namespace App\Http\Controllers;

use App\ElementsValuesStorage\ValueStorage;
use App\Http\Requests\ElementsGetAndAdd\AddCategoryElementRequest;
use App\Http\Requests\ElementsGetAndAdd\AddCategoryRequest;
use App\Http\Requests\ElementsGetAndAdd\AddElementRequest;
use App\Http\Requests\ElementsGetAndAdd\AddElementToCategoryRequest;
use App\Http\Requests\ElementsGetAndAdd\AddElementTosSubcategoryRequest;
use App\Http\Requests\ElementsGetAndAdd\AddExistValueToCategoryElementRequest;
use App\Http\Requests\ElementsGetAndAdd\AddExistValueToElementRequest;
use App\Http\Requests\ElementsGetAndAdd\AddSubcategoryRequest;
use App\Http\Requests\ElementsGetAndAdd\AddValueRangeToCategoryElementRequest;
use App\Http\Requests\ElementsGetAndAdd\AddValueRangeToElementRequest;
use App\Http\Resources\Elements\CategoryElementResource;
use App\Http\Resources\Elements\CategoryResource;
use App\Http\Resources\Elements\ElementResource;
use App\Http\Resources\Elements\UnitResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\CategoryElement;
use App\Models\Element;
use App\Models\ElementExistValue;
use App\Models\Elements\CategoryElementExistValue;
use App\Models\Elements\CategoryElementValueRange;
use App\Models\ElementValueRange;
use App\Models\Unit;
use Illuminate\Http\Request;

class ElementsController extends Controller
{
    //Addition Functions
    public function AddCategoryElement(AddCategoryElementRequest $request)
    {
        $element = new CategoryElement();

        $element->name = $request->name;
        $element->arabic_name = $request->arabic_name;
        $element->symbol = $request->symbol;
        if($request->belongs_to_element)
        {
            $element->category_id = $request->element_id;
        }
        else if($request->belongs_to_subcategory)
        {
            $element->subcategory_id = $request->element_id;
        }

        $element->is_value = $request->is_value;
        $element->is_exist = $request->is_exist;
        $element->is_subcategory = $request->is_subcategory;

        $element->save();

        if($request->units)
        {
            foreach($request->units as $unit)
            {
                $new = new Unit();

                $new->unit_name = $unit;
                $new->category_element_id = $element->id;

                $new->save();
            }
        }

        return response()->json([
            'message'=>'تم إضافة المؤشر الجزئي',
            'element'=>new CategoryElementResource($element),
        ]);
    }

    public function AddValueRangeToCategoryElement(AddValueRangeToCategoryElementRequest $request,$element_id)
    {
        $element = CategoryElement::find($element_id);
        if($element->is_value)
        {
            $new_range = new CategoryElementValueRange();

            $new_range->category_element_id = $element_id;
            $new_range->gender = $request->gender;
            $new_range->from_age = $request->from_age;
            $new_range->to_age = $request->to_age;
            $new_range->age_unit = $request->age_unit;
            $new_range->difference = $request->difference;
            $new_range->min_value = $request->min_value;
            $new_range->max_value = $request->max_value;
            $new_range->value = $request->value;
            $new_range->unit = $request->unit;
            $new_range->is_range = $request->is_range;
            $new_range->is_gender_affected = $request->is_gender_affected;
            $new_range->is_age_affected = $request->is_age_affected;
            $new_range->is_difference_affected = $request->is_difference_affected;

            $new_range->save();

            return response()->json([
                'message'=>'تم إضافة مجال القيم للمؤشر',
                'element'=>new CategoryElementResource($element),
            ]);
        }

        return response()->json([
            'message'=>'هذا المؤشر يحتوي على قيم',
        ],400);
    }

    public function AddExistValueToCategoryElement(AddExistValueToCategoryElementRequest $request, $element_id)
    {
        $element = CategoryElement::find($element_id);
        if($element->is_exist)
        {
            $new_value = new CategoryElementExistValue();

            $new_value->category_element_id = $element_id;
            $new_value->value = $request->value;
            $new_value->difference = $request->difference;
            $new_value->is_difference_affected = $request->is_difference_affected;

            $new_value->save();

            return response()->json([
                'message'=>"تم إضافة القيمة إلى المؤشر",
                'element'=>new CategoryElementResource($element),
            ]);
        }

        return response()->json([
            'message'=>"المؤشر لا يتحقق من وجود مادة",
        ],400);
    }

    public function AddValueRangeToElement(AddValueRangeToElementRequest $request,$element_id)
    {
        $element = Element::find($element_id);
        if($element->is_value)
        {
            $new_range = new ElementValueRange();

            $new_range->element_id = $element_id;
            $new_range->gender = $request->gender;
            $new_range->from_age = $request->from_age;
            $new_range->to_age = $request->to_age;
            $new_range->age_unit = $request->age_unit;
            $new_range->min_value = $request->min_value;
            $new_range->max_value = $request->max_value;
            $new_range->value = $request->value;
            $new_range->unit = $request->unit;
            $new_range->is_range = $request->is_range;
            $new_range->is_gender_affected = $request->is_gender_affected;
            $new_range->is_age_affected = $request->is_age_affected;

            $new_range->save();

            return response()->json([
                'message'=>'تم إضافة مجال القيم للمؤشر',
                'element'=>new ElementResource($element),
            ]);
        }

        return response()->json([
            'message'=>'هذا المؤشر يحتوي على قيم',
        ],400);
    }

    public function AddExistValueToElement(AddExistValueToElementRequest $request, $element_id)
    {
        $element = Element::find($element_id);
        if($element->is_exist)
        {
            $new_value = new ElementExistValue();

            $new_value->element_id = $element_id;
            $new_value->value = $request->value;
            $new_value->difference = $request->difference;
            $new_value->is_difference_affected = $request->is_difference_affected;

            $new_value->save();

            return response()->json([
                'message'=>"تم إضافة القيمة إلى المؤشر",
                'element'=>new ElementResource($element),
            ]);
        }

        return response()->json([
            'message'=>"المؤشر يتحقق من وجود مادة",
        ],400);
    }

    public function AddSubcategory(AddSubcategoryRequest $request)
    {
        $element = new CategoryElement();

        $element->name = $request->name;
        $element->arabic_name = $request->arabic_name;
        $element->symbol = $request->symbol;
        if($request->belongs_to_element)
        {
            $element->category_id = $request->element_id;
        }
        else if($request->belongs_to_subcategory)
        {
            $element->subcategory_id = $request->element_id;
        }

        $element->is_value = $request->is_value;
        $element->is_exist = $request->is_exist;
        $element->is_subcategory = $request->is_subcategory;

        $element->save();

        return response()->json([
            'message'=>'تم إنشاء الفئة الفرعية',
            'subcategory'=>new SubCategoryResource($element),
        ]);
    }

    public function AddElement(AddElementRequest $request)
    {
        error_log("in Add Element");
        $element = new Element();

        $element->name = $request->name;
        $element->arabic_name = $request->arabic_name;
        $element->symbol = $request->symbol;
        $element->is_value = $request->is_value;
        $element->is_exist = $request->is_exist;
        $element->is_category = $request->is_category;

        $element->save();

        if($request->units)
        {
            foreach($request->units as $unit)
            {
                $new = new Unit();

                $new->unit_name = $unit;
                $new->element_id = $element->id;

                $new->save();
            }
        }

        return response()->json([
            'message'=>'تم إضافة المؤشر',
            'element'=>new ElementResource($element),
        ]);
    }

    public function AddCategory(AddCategoryRequest $request)
    {
        $element = new Element();

        $element->name = $request->name;
        $element->arabic_name = $request->arabic_name;
        $element->symbol = $request->symbol;
        $element->is_value = $request->is_value;
        $element->is_exist = $request->is_exist;
        $element->is_category = $request->is_category;

        $element->save();

        return response()->json([
            'message'=>'تم إنشاء الفئة',
            'subcategory'=>new CategoryResource($element),
        ]);
    }

    //Possibly Needed Functions
    public function AddElementsToCategory(AddElementToCategoryRequest $request, $id)
    {
        $elements = CategoryElement::whereIn('id',$request->elements)->get();

        foreach($elements as $element)
        {
            $element->category_id = $id;

            $element->save();
        }

        return response()->json([
            'message'=>'تم إضافة المؤشرات إلى الفئة',
            'category'=>new CategoryResource(Element::find($id)),
        ]);
    }

    public function AddElementsToSubcategory(AddElementTosSubcategoryRequest $request, $id)
    {
        $elements = CategoryElement::whereIn('id',$request->elements)->get();

        foreach($elements as $element)
        {
            $element->subcategory_id = $id;

            $element->save();
        }

        return response()->json([
            'message'=>'تم إضافة المؤشرات إلى الفئة الجزئية',
            'category'=>new SubCategoryResource(CategoryElement::find($id)),
        ]);
    }

    //Getting Function
    public function GetSubCategories()
    {
        $subcategories = CategoryElement::where('is_subcategory',true)->get();

        return SubCategoryResource::collection($subcategories);
    }

    public function GetSubcategory($id)
    {
        $subcategory = CategoryElement::find($id);

        return new SubCategoryResource($subcategory);
    }

    public function GetCategories()
    {
        $categories = Element::where('is_category',true)->get();

        return CategoryResource::collection($categories);
    }

    public function GetCategory($id)
    {
        $category = Element::find($id);

        return new CategoryResource($category);
    }

    public function GetCategoryElements()
    {
        $elements = CategoryElement::where('subcategory_id',null)->get();

        return CategoryElementResource::collection($elements);
    }

    public function GetCategoryElement($id)
    {
        $element = CategoryElement::find($id);

        return new CategoryElementResource($element);
    }

    public function GetElements()
    {
        $elements = Element::all();

        return ElementResource::collection($elements);
    }

    public function GetElement($id)
    {
        $element = Element::find($id);

        return new ElementResource($element);
    }

    public function GetElementUnits($id)
    {
        $element = Element::find($id);

        return UnitResource::collection($element->units);
    }

    public function GetCategoryElementUnits($id)
    {
        $element = CategoryElement::find($id);

        return UnitResource::collection($element->units);
    }

    public function AddUnitToElement(Request $request, $id)
    {
        $unit = new Unit();

        $unit->element_id = $id;
        $unit->unit_name = $request->unit;

        $unit->save();

        return response()->json(['message'=>"تم إضافة وحدة القياس إلى المؤشر"]);
    }

    public function AddUnitToCategoryElement(Request $request, $id)
    {
        $unit = new Unit();

        $unit->category_element_id = $id;
        $unit->unit_name = $request->unit;

        $unit->save();

        return response()->json(['message'=>"تم إضافة وحدة القياس إلى المؤشر الجزئي"]);
    }
}
