<?php

namespace App\Http\Resources;

use App\Models\Patienttest;
use App\Models\Test;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TestReportCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    //public $collects = Patienttest::class;

    public function toArray($request)
    {
        return [
            'data'=>patienttestResource::collection($this->collection),
            'count'=>$this->count(),
        ];
    }
}
