<?php

namespace Modules\Content\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class Taxonomy extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'taxonomy' => $this->taxonomy,
            'description' => $this->description,
            'count' => $this->count,
            'term' => new Term($this->term),
            'parent' => $this->parent
        ];
        if (isset($this->contents_count)) {
            $data['contents_count'] = $this->contents_count;
        }
        return $data;
    }
}
