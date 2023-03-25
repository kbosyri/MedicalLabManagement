<?php

namespace App\Http\Resources;

use App\Models\Elements\CategoryElementValueRange;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryElementValueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    protected $collects = CategoryElementValueRange::class;

    public function toArray($request)
    {
        return [
            'gender'=>$this->gender,
            'from_age'=>$this->from_age,
            'to_age'=>$this->to_age,
            'difference'=>$this->difference,
            'min_value'=>$this->min_value,
            'max_value'=>$this->max_value,
            'value'=>$this->value,
            'unit'=>$this->unit,
            'is_range'=>$this->is_range,
            'is_gender_affected'=>$this->is_gender_affected,
            'is_age_affected'=>$this->is_age_affected,
            'is_difference_affected'=>$this->is_difference_affected,
        ];
    }
}
