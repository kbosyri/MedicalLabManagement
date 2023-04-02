<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
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
            'first_name'=>$this->First_Name,
            'last_name'=>$this->Last_Name,
            'father_name'=>$this->Father_Name,
            'username'=>$this->username,
            'gender'=>$this->Gender,
            'date_of_birth'=>$this->Date_Of_Birth,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'is_active'=>$this->is_active,

        ];
    }
}
