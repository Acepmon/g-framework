<?php

namespace Modules\System\Http\Controllers\API\v1;

use Auth;
use App\Content;
use App\Term;
use App\TermTaxonomy;
use App\TermRelationship;
use App\Entities\NotificationManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\System\Transformers\UserNotificationCollection;

class NotificationController extends Controller
{
    public function userAll(Request $request)
    {
        $type = $request->input('type', '');
        $user_id = Auth::user()->id;
        $contents = NotificationManager::all($user_id, $type)->get();

        return new UserNotificationCollection($contents);
    }

    public function userUnread(Request $request)
    {
        $type = $request->input('type', '');
        $user_id = Auth::user()->id;
        $contents = NotificationManager::unread($user_id, $type)->paginate(10);

        return new UserNotificationCollection($contents);
    }

    public function userRead(Request $request)
    {
        $type = $request->input('type', '');
        $user_id = Auth::user()->id;
        NotificationManager::read($user_id, $type);

        return null;
    }

    public function userReadSingle($notification, Request $request)
    {
        return NotificationManager::readSingle($notification);
    }
    
}