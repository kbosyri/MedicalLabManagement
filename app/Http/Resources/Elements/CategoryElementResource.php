<?php

namespace App\Http\Resources\Elements;

use App\Http\Resources\CategoryElementExistValueResource;
use App\Http\Resources\CategoryElementValueResource;
use App\Http\Resources\SubCategoryElementResource;
use App\Models\CategoryElement;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryElementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    protected $collects = CategoryElement::class;

    public function toArray($request)
    {
        $array = [
            'id'=>$this->id,
            'name'=>$this->name,
            'arabic_name'=>$this->arabic_name,
            'symbol'=>$this->symbol,
            'is_value'=>$this->is_value,
            'is_exist'=>$this->is_exist,
            'units'=>ElementUnitResource::collection($this->units),
        ];
        
        if($this->is_value)
        {
            $array['values'] = CategoryElementValueResource::collection($this->values);
        }
        else if($this->is_exist)
        {
            $array['values'] = CategoryElementExistValueResource::collection($this->values);
        }
        else if($this->is_subcategory)
        {
            $array['elements'] = SubCategoryElementResource::collection($this->values);
        }

        if($this->category_id)
        {
            $array['category'] = new CategoryElementCategoryResource($this->category);
        }
        else if($this->subcategory_id)
        {
            $array['subcategory'] = new CategoryElementSubCategoryResource($this->category);
        }

        return $array;
    }
}
