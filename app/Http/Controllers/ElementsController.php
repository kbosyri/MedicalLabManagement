<?php

namespace App\Http\Controllers;

use App\ElementsValuesStorage\ValueStorage;
use App\Models\CategoryElement;
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
            
        }
        else if($element->is_exist)
        {

        }

        return response()->json(['message'=>'Category Element Created Successfully']);
    }

    public function GetSubCategories()
    {

    }

    public function GetCategories()
    {

    }

    public function GetCategoryElements()
    {

    }

    public function GetElements()
    {
        
    }
}
