<?php

namespace App\Http\Resources;

use App\Models\Elements\CategoryElementExistValue;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryElementExistValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    protected $collects = CategoryElementExistValue::class;
    
    public function toArray($request)
    {
        return [
            'value'=>$this->value,
            'difference'=>$this->difference,
            'is_difference_affected'=>$this->is_difference_affected,
        ];
    }
}
