<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchContactResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'bio' => $this->bio,
            'about' => $this->about,
            'email' => $this->email,
            'contactssss' => $this->owners()->where('owner_id', auth()->user()->id)->first(),

            // 'id' => $this->id,

        ];
    }
}
