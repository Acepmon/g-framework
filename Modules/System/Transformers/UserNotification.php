<?php

namespace Modules\System\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class UserNotification extends Resource
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
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->metaValue('body'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
