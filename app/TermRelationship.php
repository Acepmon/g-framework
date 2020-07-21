<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermRelationship extends Model
{
    //
    public $timestamps = false;

    public function content() {
        return $this->belongsTo('App\Content');
    }

    public function isRead() {
        $unread = Term::where('slug', 'unread')->first()->taxonomy->id;
        if (TermRelationship::where([['content_id', $this->content_id], ['user_id', $this->user_id], ['term_taxonomy_id', $unread]])->count() > 0) {
            return false;
        }
        return true;
    }
}
