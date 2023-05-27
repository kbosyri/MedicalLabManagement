<?php

namespace App\Http\Resources\Staff;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffRoleResource extends JsonResource
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
            'tests'=>$this->tests,
            'patient_tests'=>$this->patient_tests,
            'auditing'=>$this->auditing,
            'reports'=>$this->reports,
            'announcements'=>$this->announcements,
            'job_applications'=>$this->job_applications,
            'finance'=>$this->finance,
            'human_resources'=>$this->human_resources,
        ];
    }
}
