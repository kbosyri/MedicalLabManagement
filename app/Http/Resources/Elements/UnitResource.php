<?php

namespace App\Http\Resources\Elements;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'unit_name'=>$this->unit_name,
            'element'=>new UnitElementResource($this->element),
        ];
    }
}
