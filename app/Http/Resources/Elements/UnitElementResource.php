<?php

namespace App\Http\Resources\Elements;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitElementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
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
        ];

        return $array;
    }
}
