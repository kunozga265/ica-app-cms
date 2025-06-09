<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HighlightResource extends JsonResource
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
            "sermon_id" => intval($this->sermon_id),
            "user_id" => intval($this->user_id),
            "highlight_id" => intval($this->highlight_id),
            "date" => intval($this->date),
        ];
    }
}
