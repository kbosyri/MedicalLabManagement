<?php

namespace App\Http\Controllers;

use App\ElementsValuesStorage\ValueStorage;
use App\Http\Resources\Elements\CategoryElementResource;
use App\Http\Resources\Elements\CategoryResource;
use App\Http\Resources\Elements\ElementResource;
use App\Http\Resources\SubCategoryResource;
use App\Models\CategoryElement;
use App\Models\Element;
use Illuminate\Http\Request;

class ElementsController extends Controller
{
    public function AddCategoryElement(Request $request)
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

        if($element->is_value)
        {
            ValueStorage::SetCategoryElementValueRanges($element->id,$request->values);
        }
        else if($element->is_exist)
        {
            ValueStorage::SetCategoryElementsExistValues($element->id,$request->values);
        }

        return response()->json([
            'message'=>'تم إضافة المؤشر الجزئي',
            'element'=>new CategoryElementResource($element),
        ]);
    }

    public function AddSubcategory(Request $request)
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

    public function AddElement(Request $request)
    {
        $element = new Element();

        $element->name = $request->name;
        $element->arabic_name = $request->arabic_name;
        $element->symbol = $request->symbol;
        $element->is_value = $request->is_value;
        $element->is_exist = $request->is_exist;
        $element->is_category = $request->is_category;

        $element->save();

        if($element->is_value)
        {
            ValueStorage::SetElementValueRanges($element->id,$request->values);
        }
        else if($element->is_exist)
        {
            ValueStorage::SetElementExistValues($element->id,$request->values);
        }

        return response()->json([
            'message'=>'تم إضافة المؤشر الجزئي',
            'element'=>new ElementResource($element),
        ]);
    }

    public function AddCategory(Request $request)
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

    public function GetSubCategories()
    {
        $subcategories = CategoryElement::where('is_subcategory',true)->get();

        return SubCategoryResource::collection($subcategories);
    }

    public function GetCategories()
    {
        $categories = Element::where('is_category',true)->get();

        return CategoryResource::collection($categories);
    }

    public function GetCategoryElements()
    {
        $elements = CategoryElement::where('subcategory_id',null)->get();

        return CategoryElementResource::collection($elements);
    }

    public function GetElements()
    {
        $elements = Element::all();

        return ElementResource::collection($elements);
    }
}
