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
            'id' => $this->content->id,
            'title' => $this->content->title,
            'body' => $this->content->metaValue('body'),
            'read' => $this->isRead(),
            'created_at' => $this->content->created_at,
            'updated_at' => $this->content->updated_at
        ];
    }
}
