<?php

namespace App\Http\Resources\Elements;

use App\Models\Unit;
use Illuminate\Http\Resources\Json\JsonResource;

class ElementUnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    protected $collects = Unit::class;

    public function toArray($request)
    {
        return [
            'unit_name'=>$this->unit_name,
        ];
    }
}
