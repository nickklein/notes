<?php

namespace notes\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class initTags extends JsonResource
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
            'text' => $this->tags->tag_name
        ];
    }
}
