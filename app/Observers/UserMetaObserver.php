<?php

namespace App\Observers;

use App\Content;
use App\ContentMeta;
use App\User;
use App\UserMeta;

class UserMetaObserver
{
    const DATE_METAS = ['startsAt', 'endsAt'];

    public function created(UserMeta $userMeta)
    {
        if ($userMeta->key == 'interestedCars') {
            $content = Content::findOrFail($userMeta->value);
            $content->incrementMetaValue("interested");
        }
    }

    public function updating(UserMeta $userMeta)
    {
    }

    public function deleting(UserMeta $userMeta)
    {
        if ($userMeta->key == 'interestedCars') {
            $content = Content::findOrFail($userMeta->value);
            $content->incrementMetaValue("interested", -1);
        }
    }
}
