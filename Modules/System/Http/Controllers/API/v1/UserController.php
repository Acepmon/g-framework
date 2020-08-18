<?php

namespace Modules\System\Http\Controllers\API\v1;


use Modules\Content\Transformers\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\User;
use App\Content;
use App\Entities\MediaManager;

class UserController extends Controller
{
    public function user(Request $request)
    {
        $user = $request->user();
        $user->meta = $user->metasTransform();

        return response()->json([
            'id' => $user->id,
            'username' => $user->username,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'name' => $user->name,
            'avatar' => $user->avatar,
            'language' => $user->language,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'deleted_at' => $user->deleted_at,
            'social_id' => $user->social_id,
            'social_provider' => $user->social_provider,
            'social_token' => $user->social_token,
            'meta' => $user->meta
        ]);
    }

    public function interestedCars(Request $request)
    {
        $interestedCars = $request->user()->metas()->where('key', 'interestedCars')->get()->transform(function ($item) { return intval($item->value); })->toArray();

        $type = $request->input('type', Content::TYPE_CAR);
        $status = $request->input('status', Content::STATUS_PUBLISHED);
        $visibility = $request->input('visibility', Content::VISIBILITY_PUBLIC);
        $limit = $request->input('limit', 10);

        $inputExcept = ['type', 'status', 'visibility', 'limit', 'page', 'author_id'];
        $metaInputs = array_filter($request->input(), function ($key) use ($inputExcept) {
            return !in_array($key, $inputExcept);
        }, ARRAY_FILTER_USE_KEY);

        $contents = Content::where('type', $type)->where('status', $status)->where('visibility', $visibility)->whereIn('id', $interestedCars);

        if ($request->has('author_id')) {
            $contents = $contents->where('author_id', $request->input('author_id'));
        }

        if (count($metaInputs) > 0) {
            $contents = $contents->whereHas('metas', function ($query) use ($metaInputs) {
                foreach ($metaInputs as $key => $value) {
                    $query->where('key', $key);
                    $query->where('value', $value);
                }
            });
        }

        $contents = $contents->paginate($limit);

        $contents->getCollection()->transform(function ($content) {
            return [
                "id" => $content->id,
                "title" => $content->title,
                "slug" => $content->slug,
                "type" => $content->type,
                "status" => $content->status,
                "visibility" => $content->visibility,
                "author" => $content->author,
                "created_at" => $content->created_at,
                "updated_at" => $content->updated_at,
                "meta" => $content->metasTransform(),
            ];
        });

        return response()->json($contents);
    }

    public function attachAvatar(Request $request) {
        $user = $request->user();

        $avatar = $request->avatar;
        $filename = MediaManager::storeFile($avatar, 'avatars');
        //$filename = $avatar->store('public/medias', 'ftp');
        //$filename = 'http://' . env('FTP_HOST') . ':3000/' . $filename;
        $user->avatar = $filename;
        $user->save();

        return response()->json($user);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $user->meta = $user->metasTransform();

        return new Author($user);
    }
}
