<?php

namespace Modules\Content\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class Term extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->group->slug == "car-manufacturer") {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'slug' => 'car-' . \Str::kebab($this->name),
                'group' => $this->group,
                'meta' => $this->metasTransform()
            ];
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'group' => $this->group,
            'meta' => $this->metasTransform()
        ];
    }
}
