<?php

namespace App\Http\Resources\Reports;

use App\Http\Resources\patienttestResource;
use App\Models\Patienttest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StaffTestsReportCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    protected $collects = Patienttest::class;
    
    public function toArray($request)
    {
        return [
            'data'=>patienttestResource::collection($this->collection),
            'count'=>$this->count()
        ];
    }
}
