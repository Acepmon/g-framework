<?php

namespace Modules\Car\Http\Controllers\API\v1;

use App\Content;
use App\ContentMeta;
use App\User;
use App\Entities\ContentManager;
use App\Entities\MediaManager;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('car::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('car::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        try {
            DB::beginTransaction();
            $authUser = auth('api')->user();
            
            $content = new Content();
            $title = $request->input('title', 'Sample Car');
            $slug = $request->input('slug', Str::uuid());
            $type = $request->input('type', Content::TYPE_CAR);
            $status = $request->input('status', Content::STATUS_DRAFT);
            $visibility = $request->input('visibility', Content::VISIBILITY_PRIVATE);
            $author_id = $authUser->id;

            $content->title = $title;
            $content->slug = $slug;
            $content->type = $type;
            $content->status = $status;
            $content->visibility = $visibility;
            $content->author_id = $author_id;
            $content->save();
            
            $data = ContentManager::discernMetasFromRequest($request->input());
            ContentManager::attachMetas($content->id, $data);
            
            DB::commit();
            $resp = ContentManager::contentToArray($content);
            return response()->json($resp);
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, 'Something went wrong!');
        }
    }

    public function syncMetas(Request $request) {
        $content_id = $request->route('car');

        $data = ContentManager::discernMetasFromRequest($request->input());
        ContentManager::syncMetas($content_id, $data);

        return response()->json($data);
    }

    public function attachMedias(Request $request) {
        $content_id = $request->route('car');

        $media_list = MediaManager::uploadFiles($request->medias);//$request->getContent());
        if (count($media_list) > 0) {
            $media_list = ['medias' => $media_list, 'thumbnail' => $media_list[0]];
        } else {
            $media_list = ['medias' => $media_list];
        }
        ContentManager::attachMetas($content_id, $media_list);

        return response()->json($media_list);
    }

    public function attachDoc(Request $request) {
        $content_id = $request->route('car');

        $doc_list = MediaManager::uploadFiles($request->doc);
        $doc_list = ['doctorVerificationFile' => $doc_list,
            'doctorVerified' => False,
            'doctorVerifiedBy' => '0',
            'doctorVerificationRequest' => True];
        ContentManager::attachMetas($content_id, $doc_list);

        return response()->json($doc_list);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('car::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('car::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $content = Content::find($id);
            DB::beginTransaction();
            $authUser = auth('api')->user();

            if ($authUser->id == $content->author_id) {
                if ($request->has('title')) {
                    $content->title = $request->input('title');
                }
                if ($request->has('slug')) {
                    $content->slug = $request->input('slug');
                }
                if ($request->has('type')) {
                    $content->type = $request->input('type');
                }
                if ($request->has('status')) {
                    $content->status = $request->input('status');
                }
                if ($request->has('visibility')) {
                    $content->visibility = $request->input('visibility');
                }
                $content->save();
            }
            
            $data = ContentManager::discernMetasFromRequest($request->input());
            ContentManager::syncMetas($content->id, $data);

            $content->title = \Str::startsWith($content->metaValue('modelName'), $content->metaValue('markName')) ? $content->metaValue('modelName') : $content->metaValue('markName') . ' ' . $content->metaValue('modelName');
            $content->slug = 'posts/' . $content->id;
            $content->save();

            DB::commit();

            $resp = ContentManager::contentToArray($content);
            return response()->json($resp);
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $authUser = auth('api')->user();
        $content = Content::findOrFail($id);

        if ($authUser->id == $content->author_id) {
            $content->metas()->delete();
            Content::destroy($id);
        }

        return response()->json([]);
    }
}
