<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Content extends Model
{
    const TYPE_PAGE = 'page';
    const TYPE_POST = 'post';

    const TYPE_ARRAY = [
        self::TYPE_PAGE,
        self::TYPE_POST
    ];

    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_PENDING = 'pending';

    const STATUS_ARRAY = [
        self::STATUS_DRAFT,
        self::STATUS_PUBLISHED,
        self::STATUS_PENDING
    ];

    const VISIBILITY_PUBLIC = 'public';
    const VISIBILITY_PRIVATE = 'private';
    const VISIBILITY_AUTH = 'authenticate';

    const VISIBILITY_ARRAY = [
        self::VISIBILITY_PUBLIC,
        self::VISIBILITY_PRIVATE,
        self::VISIBILITY_AUTH
    ];

    const NAMING_CONVENTION = '_';

    public function metas()
    {
        return $this->hasMany('App\ContentMeta', 'content_id');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function terms()
    {
        return $this->belongsToMany('App\TermTaxonomy', 'term_relationships');
    }

    public function medias()
    {
        $medias = $this->carInfo()->medias;
        foreach($medias as &$media) {
            $imagepath = $media;
            if (!Storage::disk('local')->exists($imagepath)) {
                $image = Storage::disk('ftp')->get($imagepath);
                Storage::disk('local')->put($imagepath, $image);
            }
            $media = Storage::disk('local')->url($imagepath);
        }
        return $medias;
    }

    public function carInfo() {
        if ($this->type != 'car') {
            return null;
        }
        return json_decode($this->metas[0]->value);
    }

    public function currentView()
    {
        $time = $this->metas->whereIn('key', ['initial', 'revision', 'revert'])->sortByDesc('id')->first()->value;
        $time = json_decode($time)->datetime;
        $name = ($this->slug == '/' || $this->slug == '') ? 'root' : $this->slug;
        return $name . self::NAMING_CONVENTION . $this->status . self::NAMING_CONVENTION . $time;
    }
}
