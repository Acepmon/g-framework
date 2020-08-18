<?php

namespace Modules\Content\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class Dealer extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "type" => $this->type,
            "metas" => $this->metasTransform()
        ];
    }
}
