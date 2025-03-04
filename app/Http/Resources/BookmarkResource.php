<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookmarkResource extends JsonResource
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
            "id" => $this->id,
            "date" => $this->date,
            "user_id" => $this->user_id,
            "sermon_id" => $this->sermon_id,
            "caption" => $this->caption,
            "caption_id" => $this->caption_id,
            "comment" => $this->comment ?? ""
        ];
    }
}
