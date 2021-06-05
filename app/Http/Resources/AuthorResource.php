<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"                =>  $this->id,
            "avatar"            =>  $this->avatar,
            "name"              =>  $this->name,
            "suffix"            =>  $this->suffix,
            "title"             =>  $this->title,
            "slug"              =>  $this->slug,
            "ica_pastor"        =>  $this->ica_pastor,
            "biography"         =>  $this->biography,
            "sermon_count"      =>  $this->sermons->count(),
        ];
    }
}
