<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
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
            "id" => intval($this->id),
            "code" => $this->code,
            "avatar" => $this->avatar,
            "name" => $this->fullName(),
            "email" => $this->email,
            "gender" => $this->gender,
            "date_of_birth" => $this->date_of_birth,
            "cell" => $this->cell->name,
            "phone_number_airtel" => $this->phone_number_airtel,
            "phone_number_tnm" => $this->phone_number_tnm,
            "phone_number_international" => $this->phone_number_international,
        ];
    }
}
