<?php

namespace Modules\Content\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use App\Content;
use App\Term;
use App\Entities\ContentManager;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        return response()->json(ContentManager::contentToArray($content));
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        //
    }

    public function publish(Request $request, $contentId) {
        try {
            DB::beginTransaction();

            $content = Content::findOrFail($contentId);
            $content->status = $request->input('status', Content::STATUS_PUBLISHED);
            $content->visibility = $request->input('visibility', Content::VISIBILITY_PUBLIC);
            
            $author = null;
            if ($request->has('publishType')) {
                $publishType = $request->input('publishType');
            } else {
                $publishType = $content->metaValue('publishType');
            }
            if ($publishType == 'best_premium' || $publishType == 'premium') {
                $author = $content->author()->first();
                $amount = $request->input('publishAmount');
                $content->setMetaValue('publishAmount', $amount);
                $content->setMetaValue('publishUnit', $request->input('publishUnit'));
                $content->setMetaValue('publishDuration', $request->input('publishDuration'));

                $cash = $author->metaValue('cash');
                if ($cash - $amount <= 0) {
                    DB::commit();
                    return response()->json(['success' => False, 'message' => 'Insufficient cash']);
                }
                $cash = $cash - $amount;
                $author->setMetaValue('cash', $cash);
            }

            $content->save();

            DB::commit();
            return response()->json(['success' => True, 'message' => "Successfully registered"]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['success' => True, 'message' => $ex->getMessage()])->setStatusCode(500);
        }
    }
}
