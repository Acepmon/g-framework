<?php

namespace Modules\Car\Http\Controllers\Admin;

use App\Entities\ContentManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use App\Content;

class CarLoanCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $pending = Content::where('type', 'loan-check')->whereDoesntHave('metas', function ($query) {
            $query->where('key', 'checked');
            $query->where('value', true);
        })->orderBy('visibility', 'desc')->get();

        $checked = Content::where('type', 'loan-check')->whereHas('metas', function ($query) {
            $query->where('key', 'checked');
            $query->where('value', true);
        })->orderBy('visibility', 'desc')->get();

        $contents = [
            \App\Content::STATUS_PENDING => $pending,
            'Checked' => $checked,
        ];

        return view('car::admin.car.loancheck.index', ['contents' => $contents]);
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
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('car::admin.car.loancheck.show');
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
        $content = Content::findOrFail($id);

        try {
            DB::beginTransaction();
            $data = ContentManager::discernMetasFromRequest($request->input());
            ContentManager::syncMetas($content->id, $data);

            DB::commit();
            return redirect()->route('admin.modules.car.loancheck.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.modules.car.loancheck.index');
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
        $pending = Content::where('type', 'loan-check')->whereDoesntHave('metas', function ($query) {
            $query->where('key', 'checked');
            $query->where('value', true);
        })->orderBy('visibility', 'desc');
        return $pending->count();
    }
}
