<?php

namespace App\Http\Resources;

use App\Models\CategoryElement;
use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
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
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'arabic_name'=>$this->arabic_name,
            'symbol'=>$this->symbol,
            'category'=>new SubCategoryCategoryResource($this->category),
            'elements'=>SubCategoryElementResource::collection($this->values),
        ];
    }
}
