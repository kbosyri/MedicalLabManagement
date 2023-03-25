<?php

namespace App\Http\Resources\Elements;

use App\Http\Resources\SubCategoryResource;
use App\Models\Element;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'cost'=>$this->cost,
        ];

        $array['content'] = [];
        foreach($this->values as $value)
        {
            if($value['is_subcategory'])
            {
                array_push($array['content'],new CategorySubCategoryResource($value));
            }
            else
            {
                array_push($array['content'],new SubCategoryResource($value));
            }
        }
        
        return $array;
    }
}
