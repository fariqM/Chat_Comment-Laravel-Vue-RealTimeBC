<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
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
            'owner_id' => $this->owner_id,
            'user_id' => $this->user_id,
            'ischatting' => $this->ischatting,
            'last_message' => $this->last_message,
            'lastmessage_time' => $this->lastmessage_time,
            'isactive' => $this->isactive,
        ];
    }
}
