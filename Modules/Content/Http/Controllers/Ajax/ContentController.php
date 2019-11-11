<?php

namespace Modules\Content\Http\Controllers\Ajax;

use Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Content;
use App\ContentMeta;
use App\Group;
use App\User;
use App\Entities\ContentManager;
use App\Entities\MediaManager;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $authUser = auth('api')->user();

        $contents = ContentManager::serializeRequest($request);

        $contents->getCollection()->transform(function ($content) use ($authUser) {
            if (isset($authUser)) {
                $interested = $authUser->metas()->where('key', 'interestedCars')->where('value', $content->id)->count();
                return ContentManager::contentToArray($content, [
                    "authInterested" => $interested ? true : false,
                ]);
            } else {
                return ContentManager::contentToArray($content);
            }
        });

        return response()->json($contents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:191',
            'slug' => 'required|max:255|unique:contents,slug',
            'content' => 'nullable',
            'status' => 'required|max:50',
            'visibility' => 'required|max:50',
            'author_id' => 'integer|exists:users,id'
        ]);

        try {
            DB::beginTransaction();
            $content = new Content();

            $content->title = $request->title;
            $content->slug = $request->has('slug')?$request->slug:\Str::uuid();
            $content->type = $request->type;
            $content->status = $request->status;
            $content->visibility = $request->visibility;
            if ($request->has('author_id')) {
                $content->author_id = $request->author_id;
            } else {
                $user = new User();
                $user->username = \Str::uuid();
                $user->email = \Str::uuid();
                $user->password = Hash::make(\Str::uuid());
                $user->language = User::LANG_EN;
                if ($request->name) {
                    $user->name = $request->name;
                }
                $user->save();
                $content->author_id = $user->id;
                $user->groups()->attach(Group::where('title', 'Guest')->get());
            }
            $content->save();
            if ($content->type == Content::TYPE_CAR) {
                $content->slug = config('content.cars.containerPage') . '/' . $content->id;
                $content->save();
            }
            Session::put('createdCarId', $content->id);

            $data = ContentManager::discernMetasFromRequest($request->input());
            ContentManager::attachMetas($content->id, $data);

            $value = new \stdClass;
            $value->datetime = time();
            $value->filename_changed = true;
            $value->before = $content;
            $value->after = $content;
            $value->user = $request->author_id;

            $content_meta = new ContentMeta();
            $content_meta->content_id = $content->id;
            $content_meta->key = 'initial';
            $content_meta->value = json_encode($value);
            $content_meta->save();

            DB::commit();
            return response()->json($content);
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, 'Something went wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        //
        $request->validate([
            'title' => 'max:191',
            'slug' => 'max:255|unique:contents,slug',
            'content' => 'nullable',
            'status' => 'max:50',
            'visibility' => 'max:50',
            'author_id' => 'integer|exists:users,id'
        ]);

        try {
            DB::beginTransaction();
            $content_id = $request->route('contentId');
            $content = Content::findOrFail($content_id);

            if ($request->has('title')) {
                $content->title = $request->title;
            }
            if ($request->has('slug')) {
                $content->slug = $request->slug;
            }
            if ($request->has('type')) {
                $content->type = $request->type;
            }
            if ($request->has('status')) {
                $content->status = $request->status;
            }
            if ($request->has('visibility')) {
                $content->visibility = $request->visibility;
            }
            if ($request->has('author_id')) {
                $content->author_id = $request->author_id;
            }
            $content->save();

            $data = ContentManager::discernMetasFromRequest($request->input());
            ContentManager::syncMetas($content->id, $data);

            DB::commit();
            return response()->json($content);
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, 'Something went wrong!');
        }
    }

    public function attachMedias(Request $request) {
        $content_id = $request->route('contentId');

        $result = [];
        $thumbnail = MediaManager::uploadFiles($request->thumbnail);
        array_push($result, ['thumbnail' => $thumbnail]);
        ContentManager::attachMetas($content_id, ['thumbnail' => $thumbnail]);
        $media_list = MediaManager::uploadFiles($request->medias);
        $media_list = ['medias' => $media_list];
        array_push($result, $media_list);
        ContentManager::attachMetas($content_id, $media_list);

        return response()->json($result);
    }

    public function detachMedias(Request $request) {
        $content_id = $request->route('contentId');

        if ($request->has('medias')) {
            foreach($request->input("medias") as $media) {
                ContentManager::deletemeta($content_id, "medias", $media);
            }
        }
        return response()->json($request->medias);
    }

    public function attachDoc(Request $request) {
        $content_id = $request->route('contentId');

        $doc_list = MediaManager::uploadFiles($request->doc);
        $doc_list = ['doc' => $doc_list];
        ContentManager::attachMetas($content_id, $doc_list);

        return response()->json($doc_list);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Content $content)
    {
        $content_id = $request->route('contentId');
        Content::destroy($content_id);
    }
}
