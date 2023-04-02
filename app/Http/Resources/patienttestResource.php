<?php

namespace App\Http\Resources;

use App\Http\Resources\Tests\TestResource;
use Illuminate\Http\Resources\Json\JsonResource;

class patienttestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $array=[
            'id'=>$this->id,
            'test_date'=>$this->test_id,
            'test_cost'=>$this->test_cost,
            'test'=> new TestResource($this->test),
            'staff'=>new StaffResource($this->staff),
            'pateint'=>new PatientResource($this->patient),
            'is_finished'=>$this->is_finished,
            'is_audited'=>$this->is_audited,
        ];
        return  $array;
    }

}
