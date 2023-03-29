<?php

namespace App\Http\Resources\Tests;

use Illuminate\Http\Resources\Json\JsonResource;

class TestGroupResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'tests'=>TestGroupTestResource::collection($this->tests),
        ];
    }
}
