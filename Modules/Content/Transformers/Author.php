<?php

namespace Modules\Content\Transformers;

use Modules\Car\Entities\Car;
use Illuminate\Http\Resources\Json\Resource;

class Author extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $dealer = $this->get_dealer_group();
        if ($dealer) {
            $dealer = new Dealer($dealer);
        } else {
            $dealer = null;
        }
        $contents_count = Car::all()->where('author_id', $this->id)->count();
        return [
            "id" => $this->id,
            "username" => $this->username,
            "email" => $this->email,
            "email_verified_at" => $this->email_verified_at,
            "name" => $this->name,
            "avatar" => $this->avatar,
            "language" => $this->language,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at,
            "social_id" => $this->social_id,
            "social_provider" => $this->social_provider,
            "social_token" => $this->social_token,
            "meta" => $this->metasTransform(),
            "contents_count" => $contents_count,
            "dealer" => $dealer
        ];
    }
}
