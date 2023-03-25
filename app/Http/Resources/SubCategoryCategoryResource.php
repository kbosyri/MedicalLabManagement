<?php

namespace App\Http\Resources;

use App\Models\Element;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryCategoryResource extends JsonResource
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
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'arabic_name'=>$this->arabic_name,
            'symbol'=>$this->symbol,
        ];
    }
}
