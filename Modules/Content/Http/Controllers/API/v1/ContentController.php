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

    public function count(Request $request)
    {
        $contents = ContentManager::filterByRequest($request)->count();

        return response()->json($contents);
    }

    public function publish(Request $request, $contentId) {
        $publishAmount = $request->input('publishAmount');
        $publishUnit = $request->input('publishUnit');
        $publishDuration = $request->input('publishDuration');
        $published = ContentManager::publish($request, $contentId, $publishAmount, $publishUnit, $publishDuration);
        if ($published != 0) {
            return response()->json(['success' => True, 'message' => "Successfully registered"]);
        } else {
            return response()->json(['success' => False, 'message' => 'Insufficient cash']);
        }
    }
}
