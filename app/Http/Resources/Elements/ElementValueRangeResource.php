<?php

namespace App\Http\Resources\Elements;

use App\Models\ElementValueRange;
use Illuminate\Http\Resources\Json\JsonResource;

class ElementValueRangeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    protected $collects = ElementValueRange::class;

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'gender'=>$this->gender,
            'from_age'=>$this->from_age,
            'to_age'=>$this->to_age,
            'min_value'=>$this->min_value,
            'max_value'=>$this->max_value,
            'value'=>$this->value,
            'unit'=>$this->unit,
            'is_range'=>$this->is_range,
            'is_gender_affected'=>$this->is_gender_affected,
            'is_age_affected'=>$this->is_age_affected,
        ];
    }
}
