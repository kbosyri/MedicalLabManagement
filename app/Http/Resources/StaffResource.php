<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $active = false;
        if($this->is_active)
        {
            $active = true;
        }

        return [
            'id'=>$this->id,
            'biometric_id'=>$this->biometric_id,
            'first_name'=>$this->first_name,
            'father_name'=>$this->father_name,
            'last_name'=>$this->last_name,
            'username'=>$this->username,
            'qualifications'=>$this->qualifications,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'is_admin'=>$this->when($this->is_admin,true,false),
            'is_lab_staff'=>$this->when($this->is_lab_staff,true,false),
            'is_reception'=>$this->when($this->is_reception,true,false),
            'is_active'=>$active,
            'is_staff'=>true,
        ];
    }
}
