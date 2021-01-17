<?php

namespace App;

use App\ContentMeta;
use App\TermTaxonomy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Content extends Model
{
    const TYPE_PAGE = 'page';
    const TYPE_POST = 'post';
    const TYPE_CAR = 'car';
    const TYPE_LOAN_CHECK = 'loan-check';
    const TYPE_NOTIFICATION = 'notification';

    const TYPE_ARRAY = [
        self::TYPE_PAGE,
        self::TYPE_POST,
        self::TYPE_CAR,
        self::TYPE_LOAN_CHECK,
        self::TYPE_NOTIFICATION
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
    const META_ARRAY = ['medias', 'advantages'];

    public static function getByMetas($key, $value, $operator = '=')
    {
        return self::whereHas('metas', function ($query) use ($key, $value, $operator) {
            $query->where('key', $key);
            if ($operator == 'in') {
                $query->whereIn('value', explode('|', $value));
            } else if ($operator == 'not in') {
                $query->whereNotIn('value', explode('|', $value));
            } else {
                $query->where('value', $operator, $value);
            }
        });
    }

    public static function inRangeMetas($key, $min, $max)
    {
        return self::whereHas('metas', function ($query) use ($key, $min, $max) {
            $query->where('key', $key);
            $query->where('value', '>=', $min);
            $query->where('value', '<=', $max);
        });
    }

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

    public function author()
    {
        return $this->hasOne('App\User', 'id', 'author_id');
    }

    public function medias($addPath = True)
    {
        $medias = array();
        $thumbnail = $this->metas->where('key', 'thumbnail')->first();
        if ($thumbnail) {
            array_push($medias, $thumbnail->value);
        }
        for ($i=2; $i<=15; $i++) {
            $media = $this->metas->where('key', 'image'.$i)->first();
            if ($media) {
                array_push($medias, $media->value);
            }
        }
        // $medias = $this->metas->where('key', 'medias');
        $media_path = array();
        foreach($medias as &$media) {
            $imagepath = $media;//->value;
            if ($addPath && !\Str::startsWith($imagepath, 'http')) {
                $imagepath = Config::getStorage() . $imagepath;
            }
            array_push($media_path, $imagepath);
            // if (!Storage::disk('local')->exists($imagepath)) {
            //     $image = Storage::disk('ftp')->get($imagepath);
            //     Storage::disk('local')->put($imagepath, $image);
            // }
            // array_push($media_path, Storage::disk('local')->url($imagepath));
        }
        return $media_path;
    }

    public function youtubeLink()
    {
        try{
            $link = $this->metaValue('link');
            // Code is taken from https://stackoverflow.com/questions/9973520/getting-youtube-video-id-the-php
            $video_id = explode("?v=", $link); // For videos like http://www.youtube.com/watch?v=...
            if (empty($video_id[1]))
                $video_id = explode("/v/", $link); // For videos like http://www.youtube.com/watch/v/..
            
            $video_id = explode("&", $video_id[1]); // Deleting any other params
            $video_id = $video_id[0];
            return $video_id;
        } catch (\ErrorException $ex) {
            // Undefined offset error
        }
        return null;
    }

    public function currentView()
    {
        $slug = $this->slug;
        if (\Str::contains($slug, '/') && $slug != '/') {
            $slug = explode('/', $slug)[0];
            $container = self::where('slug', $slug)->firstOrFail();
            $time = $container->metas->whereIn('key', ['initial', 'revision', 'revert'])->sortByDesc('id')->first()->value;
            $time = json_decode($time)->datetime;
            $name = ($slug == '/' || $slug == '') ? 'root' : $slug;
            return $name . self::NAMING_CONVENTION . $container->status . self::NAMING_CONVENTION . $time;
        } else {
            $time = $this->metas->whereIn('key', ['initial', 'revision', 'revert'])->sortByDesc('id')->first()->value;
            $time = json_decode($time)->datetime;
            $name = ($slug == '/' || $slug == '') ? 'root' : $slug;
            return $name . self::NAMING_CONVENTION . $this->status . self::NAMING_CONVENTION . $time;
        }
    }

    public function attachMeta($key, $value)
    {
        if ($key && $value && $this->id) {
            $content_meta = new ContentMeta();
            $content_meta->content_id = $this->id;
            $content_meta->key = $key;
            $content_meta->value = $value;
            $content_meta->save();
        }
    }

    public function updateMeta($key, $value)
    {
        if ($key && $value && $this->id) {
            if (is_array($value)) {
                $exists = $this->metas->where('key', $key);
                foreach($exists as $exist) {
                    if (in_array($exist->value, $value)) {
                        $value = array_diff($value, [$exist->value]);
                    } else {
                        $exist->delete();
                    }
                }
                foreach($value as $v) {
                    $this->attachMeta($key, $v);
                }
            } else {
                $exists = $this->metas->where('key', $key)->first();
                if ($exists) {
                    $exists->value = $value;
                    $exists->save();
                } else {
                    $this->attachMeta($key, $value);
                }
            }
        }
    }

    public function metaValue($key) {
        try {
            $meta = $this->metas->where('key', $key)->first();
            if ($meta) {
                if (\Str::endsWith($key, 'Amount')) {
                    if (is_numeric($meta->value)) {
                        return $meta->value;                    
                    } else {
                        $value = str_replace(",", "", $meta->value);
                        if (is_numeric($value)) {
                            return $value;
                        }
                        return '0';
                    }
                }
                return $meta->value;
            }
        } catch (\Exception $ex) {
            return Null;
        }
        return Null;
    }

    public function setMetaValue($key, $value) {
        try {
            $meta = $this->metas->where('key', $key)->first();
            if (isset($meta)) {
                $meta->value = $value;
                $meta->save();
                return $meta;
            } else {
                $newMeta = new ContentMeta();
                $newMeta->content_id = $this->id;
                $newMeta->key = $key;
                $newMeta->value = $value;
                $newMeta->save();
                return $newMeta;
            }
        } catch (\Exception $ex) {
            return Null;
        }
        return Null;
    }

    public function attachMetaArray($key, $value) {
        try {
            $newMeta = new ContentMeta();
            $newMeta->content_id = $this->id;
            $newMeta->key = $key;
            $newMeta->value = $value;
            $newMeta->save();
            return $newMeta;
        } catch (\Exception $ex) {
            return Null;
        }
        return Null;
    }

    public function incrementMetaValue($key, $inc = 1) {
        try {
            $meta = $this->metas->where('key', $key)->first();
            if (isset($meta)) {
                $meta->value = $inc + (int) $meta->value;
                $meta->save();
                return $meta;
            } else {
                $newMeta = new ContentMeta();
                $newMeta->content_id = $this->id;
                $newMeta->key = $key;
                $newMeta->value = "1";
                $newMeta->save();
                return $newMeta;
            }
        } catch (\Exception $ex) {
            return Null;
        }
        return Null;
    }

    public function metaArray($key) {
        try {
            $meta = $this->metas->where('key', $key);
            if ($meta) {
                return $meta->transform(function ($item) {
                    return $item->value;
                });
            }
        } catch (\Exception $ex) {
            return [];
        }
        return [];
    }

    public function metasTransform() {
        $arr = [];
        foreach ($this->metas->groupBy('key')->toArray() as $key => $metaValues) {

            if (count($metaValues) > 1 || in_array($key, self::META_ARRAY)) {
                $arr[$key] = array_map(function ($meta) {
                    return $this->isJson($meta['value']) ? json_decode($meta['value']) : $meta['value'];
                }, $metaValues);
            } else {
                $arr[$key] = $this->isJson($metaValues[0]['value']) ? json_decode($metaValues[0]['value']) : $metaValues[0]['value'];
            }
        }
        $arr['medias'] = $this->medias(False);
        return $arr;
    }

    private function isJson($string) {
        return ((is_string($string) &&
                (is_object(json_decode($string)) ||
                is_array(json_decode($string))))) ? true : false;
    }

    public function visibilityClass() {
        switch ($this->visibility) {
            case self::VISIBILITY_PUBLIC: return 'success';
            case self::VISIBILITY_PRIVATE: return 'secondary';
            case self::VISIBILITY_AUTH: return 'primary';
            default: return 'default';
        }
    }

    public function publishPremium() {
        $publishType = $this->metaValue('publishType');
        if ($publishType == 'best_premium' || $publishType == 'premium') {
            $author = $this->author;
            $cash = $author->metaValue('cash');
            $amount = $this->metaValue('publishAmount');
            if ($cash - $amount <= 0) {
                return false;
            }
            $cash = $cash - $amount;
            $author->setMetaValue('cash', $cash);
            $this->status = self::STATUS_PUBLISHED;
            $this->visibility = self::VISIBILITY_PUBLIC;
            $this->order = 1;
            if ($publishType == 'best_premium') {
                $this->order = 3;
            } else if ($publishType == 'premium') {
                $this->order = 2;
            }
            $this->save();
            return true;
        }
        return false;
    }

    public function thumbnail() {
        if ($this->metaValue('thumbnail')) {
            if (substr($this->metaValue('thumbnail'), 0, 4) !== 'http') {
                return Config::getStorage() . $this->metaValue('thumbnail');
            }
            return $this->metaValue('thumbnail');
        } else {
            for ($i = 2; $i <= 16; $i++) {
                if ($this->metaValue('image' . $i)) {
                    return $this->metaValue('image' . $i);
                }
            }
        }
        return "/assets/car-web/img/default.png";
    }
}
