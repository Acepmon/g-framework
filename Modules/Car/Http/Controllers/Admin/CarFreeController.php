<?php

namespace Modules\Car\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Content;

class CarFreeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $published = Content::where('type', 'car')->where('status', Content::STATUS_PUBLISHED)->whereDoesntHave('metas', function ($query) {
            $query->where('key', 'publishType');
            $query->where('value', 'premium');
        })->whereDoesntHave('metas', function ($query) {
            $query->where('key', 'publishType');
            $query->where('value', 'best_premium');
        })->orderBy('visibility', 'desc')->get();

        $pending = Content::where('type', 'car')->where('status', Content::STATUS_PENDING)->whereHas('metas', function ($query) {
            $query->where('key', 'publishType');
            $query->where('value', 'premium');
        })->whereDoesntHave('metas', function ($query) {
            $query->where('key', 'publishType');
            $query->where('value', 'best_premium');
        })->orderBy('visibility', 'desc')->get();

        $draft = Content::where('type', 'car')->where('status', Content::STATUS_DRAFT)->whereHas('metas', function ($query) {
            $query->where('key', 'publishType');
            $query->where('value', 'premium');
        })->whereDoesntHave('metas', function ($query) {
            $query->where('key', 'publishType');
            $query->where('value', 'best_premium');
        })->orderBy('visibility', 'desc')->get();

        $contents = [
            Content::STATUS_PUBLISHED => $published,
            Content::STATUS_PENDING => $pending,
            Content::STATUS_DRAFT => $draft,
        ];

        return view('car::admin.car.free.index', ['contents' => $contents]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('car::admin.car.free.create');
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
        return view('car::admin.car.free.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('car::admin.car.free.edit');
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
}
