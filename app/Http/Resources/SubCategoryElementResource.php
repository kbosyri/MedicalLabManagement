<?php

namespace App\Http\Resources;

use App\Models\CategoryElement;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryElementResource extends JsonResource
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
        ];
        if($this->is_value)
        {
            $array['values'] = CategoryElementValueResource::collection($this->values);
        }
        else
        {
            $array['values'] = CategoryElementExistValueResource::collection($this->value);
        }
        return $array;
    }
}
