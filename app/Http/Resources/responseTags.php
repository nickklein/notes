<?php

namespace notes\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class responseTags extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
    public function with($request)
    {
        return [
            'state' => 'success'
        ];
    }
}
