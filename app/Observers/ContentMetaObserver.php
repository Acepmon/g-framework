<?php

namespace App\Observers;

use App\Content;
use App\ContentMeta;
use App\Term;
use App\TermTaxonomy;
use App\Entities\TaxonomyManager;

use Carbon\Carbon;

class ContentMetaObserver
{
    const DATE_METAS = ['startsAt', 'endsAt'];

    public function created(ContentMeta $contentMeta)
    {
        $contentMeta->value = $this->validate($contentMeta->key, $contentMeta->value);
        $content = $contentMeta->content;
        if ($content->type == Content::TYPE_CAR && $content->status == Content::STATUS_PUBLISHED && $content->visibility == Content::VISIBILITY_PUBLIC
            && $content->metaValue("isAuction") != "1") {
            TaxonomyManager::incrementCount($contentMeta->key, $contentMeta->value);
        }

        if ($contentMeta->key == 'publishType') {
            // $content->updateMeta('publishedAt', Carbon::now());
            if ($contentMeta->value == 'best_premium' || $contentMeta->value == 'premium') {
                
            }
        }
        $this->publishVerified($contentMeta, $content);

        $this->calculateDays($contentMeta, 'startsAt', 'endsAt', 'publishDuration');
        $this->calculateDays($contentMeta, 'publishVerifiedAt', 'publishVerifiedEnd', 'publishDuration');
    }

    public function updating(ContentMeta $contentMeta)
    {
        $contentMeta->value = $this->validate($contentMeta->key, $contentMeta->value);
        $content = $contentMeta->content;
        if ($content->type == Content::TYPE_CAR && $content->status == Content::STATUS_PUBLISHED && $content->visibility == Content::VISIBILITY_PUBLIC
            && $content->metaValue("isAuction") != "1") {
            TaxonomyManager::decrementCount($contentMeta->key, $contentMeta->getOriginal('value'));
            TaxonomyManager::incrementCount($contentMeta->key, $contentMeta->value);
        }

        $this->calculateDays($contentMeta, 'startsAt', 'endsAt', 'publishDuration');
        $this->calculateDays($contentMeta, 'publishVerifiedAt', 'publishVerifiedEnd', 'publishDuration');
    }

    public function deleting(ContentMeta $contentMeta)
    {
        $content = $contentMeta->content;
        if ($content->type == Content::TYPE_CAR && $content->status == Content::STATUS_PUBLISHED && $content->visibility == Content::VISIBILITY_PUBLIC
            && $content->metaValue("isAuction") != "1") {
            TaxonomyManager::decrementCount($contentMeta->key, $contentMeta->value);
        }
    }


    public function publishVerified($contentMeta, $content) {
        if ($contentMeta->key == 'publishVerified' && $contentMeta->value == '1') {
            $publishType = $content->metaValue('publishType');
            $content->order = 1;
            if ($publishType == 'premium') {
                $content->order = 2;
            } else if ($publishType == 'best_premium') {
                $content->order = 3;
            }
            $content->save();
        }
    }

    public function calculateDays($contentMeta, $startsAt, $endsAt, $duration) {
        if ($contentMeta->key == $startsAt) {
            $duration = $contentMeta->content->metaValue($duration);
            if ($duration) {
                $contentMeta->content->updateMeta($endsAt, $this->validate('endsAt', $contentMeta->value . ' +' . $duration . ' days'));
            }
        }
    }

    public function validate($key, $value) {
        if (in_array($key, self::DATE_METAS)) {
            $value = date('Y-m-d H:i:s', strtotime($value));
        }
        return $value;
    }
}
