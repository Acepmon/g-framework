<?php

namespace Modules\Car\Http\Controllers\Admin;

use App\Entities\ContentManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use App\Content;
use App\Term;

class CarVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $verified = Term::where('slug', 'batalgaazhsan')->first();
        $notVerified = Term::where('slug', 'batalgaazhaagy')->first();

        $published = Content::where('type', 'car')->where('status', Content::STATUS_PUBLISHED)->whereHas('terms', function ($query) use($notVerified) {
            $query->where('term_id', $notVerified->id);
        })->orderBy('visibility', 'desc')->get();

        $pending = Content::where('type', 'car')->where('status', Content::STATUS_PENDING)->whereHas('terms', function ($query) use($notVerified) {
            $query->where('term_id', $notVerified->id);
        })->orderBy('visibility', 'desc')->get();

        $draft = Content::where('type', 'car')->where('status', Content::STATUS_DRAFT)->whereHas('terms', function ($query) use ($notVerified) {
            $query->where('term_id', $notVerified->id);
        })->orderBy('visibility', 'desc')->get();
        // $published = Content::where('type', 'car')->where('status', Content::STATUS_PUBLISHED)->whereHas('metas', function ($query) {
        //     $query->where('key', 'doctorVerificationRequest');
        //     $query->where('value', true);
        // })->orderBy('visibility', 'desc')->get();

        // $pending = Content::where('type', 'car')->where('status', Content::STATUS_PENDING)->whereHas('metas', function ($query) {
        //     $query->where('key', 'doctorVerificationRequest');
        //     $query->where('value', true);
        // })->orderBy('visibility', 'desc')->get();

        // $draft = Content::where('type', 'car')->where('status', Content::STATUS_DRAFT)->whereHas('metas', function ($query) {
        //     $query->where('key', 'doctorVerificationRequest');
        //     $query->where('value', true);
        // })->orderBy('visibility', 'desc')->get();

        $contents = [
            Content::STATUS_PUBLISHED => $published,
            Content::STATUS_PENDING => $pending,
            Content::STATUS_DRAFT => $draft,
        ];

        return view('car::admin.car.verifications.index', ['contents' => $contents]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('car::admin.car.verifications.create');
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
        return view('car::admin.car.verifications.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('car::admin.car.verifications.edit');
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
        $verified = Term::where('slug', 'batalgaazhsan')->first();
        $notVerified = Term::where('slug', 'batalgaazhaagy')->first();

        try {
            DB::beginTransaction();
            $data = ContentManager::discernMetasFromRequest($request->input());
            ContentManager::syncMetas($content->id, $data);
            $content->terms()->detach($notVerified);
            $content->terms()->attach($verified);

            DB::commit();
            return redirect()->route('admin.modules.car.verifications.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.modules.car.verifications.index');
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
        $notVerified = Term::where('slug', 'batalgaazhaagy')->first();        
        $published = Content::where('type', 'car')->whereHas('terms', function ($query) use($notVerified) {
            $query->where('term_id', $notVerified->id);
        })->orderBy('visibility', 'desc');
        return $published->count();
    }
}
