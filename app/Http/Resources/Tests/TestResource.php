<?php

namespace App\Http\Resources\Tests;

use App\Http\Resources\Elements\ElementResource;
use App\Models\Test;
use Illuminate\Http\Resources\Json\JsonResource;

class TestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    protected $collects = Test::class;

    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'arabic_name'=>$this->arabic_name,
            'symbol'=>$this->symbol,
            'cost'=>$this->cost,
            'elements'=>ElementResource::collection($this->elements),
            'groups'=>TestTestGroupResource::collection($this->groups),
        ];
    }
}
