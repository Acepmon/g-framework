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
use App\Term;
use App\Entities\ContentManager;
use App\Entities\MediaManager;
use App\Events\MessagePushed;

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

            if ($request->type == Content::TYPE_LOAN_CHECK) {
                event(new MessagePushed('Loan Check'));
            }

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
        $inputs = $request->all();
        foreach ($inputs as $key=>$value) {
            $data = MediaManager::uploadFiles($value);
            array_push($result, [$key => $data]);
            ContentManager::syncMetas($content_id, [$key => $data]);
        }

        return response()->json($result);
    }

    public function detachMedias(Request $request) {
        $content_id = $request->route('contentId');

        $result = [];
        $inputs = $request->input("medias");
        if ($inputs) {
            foreach ($inputs as $input) {
                $meta = ContentMeta::findOrFail($input);
                MediaManager::deleteFile($meta->value);
                $meta->delete();
            }
        }
        return response()->json($result);
    }

    public function attachDoc(Request $request) {
        $content_id = $request->route('contentId');

        $doc_list = MediaManager::uploadFiles($request->doc);
        $doc_list = ['doctorVerificationFile' => $doc_list,
            'doctorVerified' => False,
            'doctorVerifiedBy' => '0',
            'doctorVerificationRequest' => True];
        ContentManager::syncMetas($content_id, $doc_list);
        event(new MessagePushed('Verification Requests'));

        return response()->json($doc_list);
    }

    public function attachTerms(Request $request) {
        $content = Content::find($request->route('contentId'));

        $result = [];
        $inputs = $request->all();
        foreach ($inputs as $key=>$value) {
            $term = Term::find($value);
            $content->terms()->save($term);
        }

        return response()->json("yes");
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

    public function publish(Request $request, $contentId) {
        $publishPricing = $request->input('publishPricing');
        $pricingTerm = Term::find($publishPricing);
        $publishAmount = $pricingTerm?$pricingTerm->metaValue('amount'):'';
        $publishUnit = $pricingTerm?$pricingTerm->metaValue('unit'):'';
        $publishDuration = $pricingTerm?$pricingTerm->metaValue('duration'):'';
        $published = ContentManager::publish($request, $contentId, $publishAmount, $publishUnit, $publishDuration);
        event(new MessagePushed('Cars'));
        if ($published) {
            return response()->json(['message' => "Successfully registered"]);
        } else {
            return response()->json(['message' => 'Insufficient cash'])->setStatusCode(500);
        }
    }
}
