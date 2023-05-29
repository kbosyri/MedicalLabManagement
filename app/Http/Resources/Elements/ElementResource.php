<?php

namespace App\Http\Resources\Elements;

use App\Models\Element;
use Illuminate\Http\Resources\Json\JsonResource;

class ElementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    protected $collects = Element::class;

    public function toArray($request)
    {
        $array = [
            'id'=>$this->id,
            'name'=>$this->name,
            'arabic_name'=>$this->arabic_name,
            'symbol'=>$this->symbol,
            'is_value'=>$this->is_value,
            'is_exist'=>$this->is_exist,
            'is_category'=>$this->is_category,
            'units'=>ElementUnitResource::collection($this->units),
        ];

        if($this->is_value)
        {
            $array['values'] = ElementValueRangeResource::collection($this->values);
        }
        else if($this->is_exist)
        {
            $array['values'] = ElementExistValueResource::collection($this->values);
        }
        else if($this->is_category)
        {
            $array['values'] = [];
            foreach($this->values as $value)
            {
                if($value['is_subcategory'])
                {
                    array_push($array['values'],new ElementSubCategoryResource($value));
                }
                else
                {
                    array_push($array['values'],new ElementCategoryElementResource($value));
                }
            }
        }

        $units = [];

        foreach($this->units as $unit)
        {
            array_push($units,$unit->unit_name);
        }

        $array['units'] = $units;

        return $array;
    }
}
