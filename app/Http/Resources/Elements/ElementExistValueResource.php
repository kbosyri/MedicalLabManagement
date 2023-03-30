<?php

namespace App\Http\Resources\Elements;

use App\Models\ElementExistValue;
use Illuminate\Http\Resources\Json\JsonResource;

class ElementExistValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    protected $collects = ElementExistValue::class;

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'value'=>$this->value,
            'difference'=>$this->difference,
            'is_difference_affected'=>$this->is_difference_affected,
        ];
    }
}
