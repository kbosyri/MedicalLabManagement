<?php

namespace App\Http\Resources\Elements;

use App\Models\Element;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryElementCategoryResource extends JsonResource
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
        
        return $array;
    }
}
