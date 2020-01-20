<?php

namespace Modules\Content\Http\Controllers;

use App\Group;
use App\GroupMeta;
use App\Entities\MediaManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('content::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('content::create');
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
        return view('content::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('content::edit');
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

    public static function register($group, $data)
    {
        $company = Group::create([
            'parent_id' => $group->id,
            'title' => array_key_exists('companyName', $data) ? $data['companyName'] : 'Dealer',
            'description' => array_key_exists('description', $data) ? $data['description'] : '',
            'type' => 'dealer'
        ]);
        if (request()->hasFile('retailImage')) {
            $filename = MediaManager::storeFile(request()->file('retailImage'), 'avatars/retail');
            GroupMeta::create(['group_id' => $company->id, 'key' => 'retailImage', 'value' => array_key_exists('retailImage', $data) ? $filename : '']);
        }
        GroupMeta::create(['group_id' => $company->id, 'key' => 'website', 'value' => array_key_exists('website', $data) ? $data['website'] : '']);
        GroupMeta::create(['group_id' => $company->id, 'key' => 'schedule', 'value' => array_key_exists('schedule', $data) ? $data['schedule'] : '']);
        GroupMeta::create(['group_id' => $company->id, 'key' => 'address', 'value' => array_key_exists('address', $data) ? $data['address'] : '']);
        return $company;
    }
}
