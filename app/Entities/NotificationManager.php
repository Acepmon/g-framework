<?php

namespace App\Entities;

use Auth;
use App\Content;
use App\Term;
use App\TermTaxonomy;
use App\TermRelationship;
use App\User;
use Illuminate\Support\Facades\DB;

class NotificationManager extends Manager
{
    //
    public static function store($title, $body, $type, $user_id = null) {

        try {
            DB::beginTransaction();

            $content = new Content();
            $content->title = $title;
            $content->slug = \Str::uuid();
            $content->type = Content::TYPE_NOTIFICATION;
            $content->status = Content::STATUS_PUBLISHED;
            $content->author_id = Auth::user()->id;
            $content->visibility = Content::VISIBILITY_PUBLIC;
            $content->save();
            ContentManager::addMeta($content->id, "body", $body);

            $type = Term::where('name', $type)->first()->taxonomy;
            $unread = Term::where('name', "Unread")->first()->taxonomy;
            if ($user_id) {
                $rel = new TermRelationship();
                $rel->content_id = $content->id;
                $rel->term_taxonomy_id = $type->id;
                $rel->user_id = $user_id;
                $rel->save();
                $rel = new TermRelationship();
                $rel->content_id = $content->id;
                $rel->term_taxonomy_id = $unread->id;
                $rel->user_id = $user_id;
                $rel->save();
            } else {
                foreach(User::all() as $user) {
                    $rel = new TermRelationship();
                    $rel->content_id = $content->id;
                    $rel->term_taxonomy_id = $type->id;
                    $rel->user_id = $user->id;
                    $rel->save();
                    $rel = new TermRelationship();
                    $rel->content_id = $content->id;
                    $rel->term_taxonomy_id = $unread->id;
                    $rel->user_id = $user->id;
                    $rel->save();
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public static function all($user_id, $type = '') {
        $type = Term::where('slug', 'notification-' . strtolower($type));

        if ($type->count() > 0) {
            $typeId = $type->first()->taxonomy->id;
            $result = TermRelationship::where('user_id', $user_id)->where('term_taxonomy_id', $typeId);
    
            return $result;
        }

        $notification_terms = TermTaxonomy::where('taxonomy', 'notifications')->pluck('id');
        $result = TermRelationship::where('user_id', $user_id)->whereIn('term_taxonomy_id', $notification_terms);
        return $result;
    }

    public static function unread($user_id, $type = '') {
        $unread = Term::where('slug', 'unread')->first()->taxonomy->id;
        $type = Term::where('slug', 'notification-' . strtolower($type));
        if ($type->count() > 0) {
            $typeId = $type->first()->taxonomy->id;
            $unread_ids = TermRelationship::where('user_id', $user_id)->where('term_taxonomy_id', $unread)->pluck('content_id');
            $result = TermRelationship::where('user_id', $user_id)->whereIn('content_id', $unread_ids)->where('term_taxonomy_id', $typeId);
    
            return $result;
        }

        $notification_terms = TermTaxonomy::where('taxonomy', 'notifications')->pluck('id');
        $unread_ids = TermRelationship::where('user_id', $user_id)->where('term_taxonomy_id', $unread)->pluck('content_id');
        $result = TermRelationship::where('user_id', $user_id)->whereIn('content_id', $unread_ids)->whereIn('term_taxonomy_id', $notification_terms);

        return $result;
    }

    public static function read($user_id, $type = '') {
        $type = Term::where('slug', 'notification-' . strtolower($type));
        $unread = Term::where('slug', 'unread')->first()->taxonomy->id;
        if ($type->count() > 0) {
            $typeId = $type->first()->taxonomy->id;
            $unread_ids = TermRelationship::where('user_id', $user_id)->where('term_taxonomy_id', $typeId)->pluck('content_id');
            $notifications = TermRelationship::where('user_id', $user_id)->whereIn('content_id', $unread_ids)->where('term_taxonomy_id', $unread);
            $notifications->delete();
            // foreach($notifications as $notification) {
            //     TermRelationship::destroy($notification->id);
            // }
            return null;
        }
        
        $notifications = TermRelationship::where('user_id', $user_id)->where('term_taxonomy_id', $unread);
        $notifications->delete();
        return null;
    }
}
