<?php

namespace Modules\System\Http\Controllers\Admin;

use Auth;
use App\Entities\ContentManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use App\Content;
use App\Term;
use App\TermRelationship;
use App\TermTaxonomy;
use App\User;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $notifications = Content::where('type', Content::TYPE_NOTIFICATION)->get();
        return view('admin.notifications.index', ['notifications' => $notifications]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $types = TermTaxonomy::where('taxonomy', 'notifications')->get();
        return view('admin.notifications.create', ['types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|max:191',
            'type' => 'required|max:191',
        ]);

        try {
            DB::beginTransaction();

            $content = new Content();
            $content->title = $request->input('title');
            $content->slug = \Str::slug($request->input('title'));
            $content->type = Content::TYPE_NOTIFICATION;
            $content->status = Content::STATUS_PUBLISHED;
            $content->author_id = Auth::id();
            $content->visibility = Content::VISIBILITY_PUBLIC;
            $content->save();
            ContentManager::addMeta($content->id, "body", $request->input('body'));

            $type = Term::where('name', $request->input('type'))->first()->taxonomy;
            $unread = Term::where('name', "Unread")->first()->taxonomy;
            foreach(User::all() as $user) {
                $rel = new TermRelationship();
                $rel->content_id = $content->id;
                $rel->term_taxonomy_id = $type->id;
                $rel->user_id = $user->id;
                $rel->save();
                $rel = new TermRelationship();
                $rel->content_id = $content->id;
                $rel->term_taxonomy_id = $unread->id;
                $rel->user_id = $user->id;
                $rel->save();
            }

            DB::commit();
            return redirect()->route('admin.notifications.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.notifications.create')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $content = Content::findOrFail($id);
        $unread = Term::where('name', "Unread")->first()->taxonomy->id;
        $all = count(TermRelationship::where('content_id', $content->id)->get());
        $read = count(TermRelationship::where('content_id', $content->id)->where('term_taxonomy_id', $unread)->get());
        $all = $all - $read;
        return view('admin.notifications.show', ['notification' => $content, 'count' => $read . "/" . $all]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $content = Content::findOrFail($id);

        return view('admin.notifications.edit', ['notification' => $content]);
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
        $content->title = $request->input('title');
        $content->updateMeta('body', $request->input('body'));
        $content->save();

        $notifications = Content::where('type', Content::TYPE_NOTIFICATION)->get();
        return redirect()->route('admin.notifications.index', ['notifications' => $notifications]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        // $content = Content::findOrFail($id);
        // $content->
        Content::destroy($id);
        
        $notifications = Content::where('type', Content::TYPE_NOTIFICATION)->get();
        return redirect()->route('admin.notifications.index', ['notifications' => $notifications]);
    }
}
