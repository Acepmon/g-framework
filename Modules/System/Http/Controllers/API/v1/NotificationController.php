<?php

namespace Modules\System\Http\Controllers\API\v1;

use Auth;
use App\Content;
use App\Term;
use App\TermTaxonomy;
use App\TermRelationship;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\System\Transformers\UserNotificationCollection;

class NotificationController extends Controller
{
    public function userAll(Request $request)
    {
        $type = $request->input('type', '');
        $type = Term::where('slug', 'notification-' . strtolower($type));
        if ($type->count() > 0) {
            $typeId = $type->first()->taxonomy->id;
            $content_ids = TermRelationship::where('user_id', Auth::user()->id)->where('term_taxonomy_id', $typeId)->pluck('content_id');
            $contents = Content::whereIn('id', $content_ids)->get();
    
            return new UserNotificationCollection($contents);
        }

        $notification_terms = TermTaxonomy::where('taxonomy', 'notifications')->pluck('id');
        $content_ids = TermRelationship::where('user_id', Auth::user()->id)->whereIn('term_taxonomy_id', $notification_terms)->pluck('content_id');
        $contents = Content::whereIn('id', $content_ids)->get();

        return new UserNotificationCollection($contents);
    }

    public function userUnread(Request $request)
    {
        $type = $request->input('type', '');
        $type = Term::where('slug', 'notification-' . strtolower($type));
        $unread = Term::where('slug', 'unread')->first()->taxonomy->id;
        if ($type->count() > 0) {
            $typeId = $type->first()->taxonomy->id;
            $unread_ids = TermRelationship::where('user_id', Auth::user()->id)->where('term_taxonomy_id', $unread)->pluck('content_id');
            $content_ids = TermRelationship::where('user_id', Auth::user()->id)->whereIn('content_id', $unread_ids)->where('term_taxonomy_id', $typeId)->pluck('content_id');
            $contents = Content::whereIn('id', $content_ids)->get();
    
            return new UserNotificationCollection($contents);
        }

        $notification_terms = TermTaxonomy::where('taxonomy', 'notifications')->pluck('id');
        $unread_ids = TermRelationship::where('user_id', Auth::user()->id)->where('term_taxonomy_id', $unread)->pluck('content_id');
        $content_ids = TermRelationship::where('user_id', Auth::user()->id)->whereIn('content_id', $unread_ids)->whereIn('term_taxonomy_id', $notification_terms)->pluck('content_id');
        $contents = Content::whereIn('id', $content_ids)->get();

        return new UserNotificationCollection($contents);
    }

    public function userRead(Request $request)
    {
        $type = $request->input('type', '');
        $type = Term::where('slug', 'notification-' . strtolower($type));
        $unread = Term::where('slug', 'unread')->first()->taxonomy->id;
        if ($type->count() > 0) {
            $typeId = $type->first()->taxonomy->id;
            $unread_ids = TermRelationship::where('user_id', Auth::user()->id)->where('term_taxonomy_id', $unread)->pluck('content_id');
            $notifications = TermRelationship::where('user_id', Auth::user()->id)->whereIn('content_id', $unread_ids)->where('term_taxonomy_id', $typeId);
            $notifications->delete();
            // foreach($notifications as $notification) {
            //     TermRelationship::destroy($notification->id);
            // }
            return null;
        }
        
        $notifications = TermRelationship::where('user_id', Auth::user()->id)->where('term_taxonomy_id', $unread);
        $notifications->delete();
        // foreach($notifications as $notification) {
        //     $notification->delete();
        // }
        return null;
    }
    
}