<?php

namespace Modules\Car\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Content;

class CarPremiumController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $common = Content::where('type', 'car')->whereHas('metas', function($query) {
            $query->where('key', 'publishType');
            $query->where('value', 'premium');
        })->whereDoesntHave('metas', function ($query) {
            $query->where('key', 'isAuction');
            $query->where('value', '1');
        });
        
        $request = clone $common;
        $published = clone $common;
        $pending = clone $common;
        $draft = clone $common;

        $request = $request->where('status', Content::STATUS_PUBLISHED)->where('visibility', Content::VISIBILITY_PUBLIC)->whereDoesntHave('metas', function($query) {
            $query->where('key', 'publishVerified');
            $query->where('value', '1');
        })->get();
        $published = $published->where('status', Content::STATUS_PUBLISHED)->orderBy('visibility', 'desc')->get();
        $pending = $pending->where('status', Content::STATUS_PENDING)->orderBy('visibility', 'desc')->get();
        $draft = $draft->where('status', Content::STATUS_DRAFT)->orderBy('visibility', 'desc')->get();

        $contents = [
            'Requests' => $request,
            Content::STATUS_PUBLISHED => $published,
            Content::STATUS_PENDING => $pending,
            Content::STATUS_DRAFT => $draft,
        ];

        return view('car::admin.car.premium.index', ['contents' => $contents]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('car::admin.car.premium.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('car::admin.car.premium.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('car::admin.car.premium.edit');
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
        $content = Content::findOrFail($id);

        try {
            DB::beginTransaction();
            $data = ContentManager::discernMetasFromRequest($request->input());
            if ($data['publishVerified']) {
                $data['publishVerifiedAt'] = now();
            }
            ContentManager::syncMetas($content->id, $data);

            DB::commit();
            return redirect()->route('admin.modules.car.premium.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.modules.car.premium.index');
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
    }

    public static function getCount() {
        $common = Content::where('type', 'car')->whereHas('metas', function($query) {
            $query->where('key', 'publishType');
            $query->where('value', 'premium');});
        $request = $common->where('status', Content::STATUS_PUBLISHED)->where('visibility', Content::VISIBILITY_PUBLIC)->whereDoesntHave('metas', function($query) {
            $query->where('key', 'publishVerified');
            $query->where('value', '1');
        });
        return $request->count();
    }
}
