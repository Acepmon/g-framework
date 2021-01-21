<?php

namespace Modules\System\Http\Controllers\Admin;

use App\Entities\MediaManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Group;
use App\Menu;
use App\User;
use App\Permission;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Group::where('type', Group::TYPE_COMPANY)->get();

        return view('admin.company.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'companyName' => 'required|max:100',
            'description' => 'nullable|max:250',
        ]);

        $group = new Group;
        $parent_id = Group::where('title', 'Auto Dealer')->first()->id;
        $group->parent_id = $parent_id;
        $group->title = $request->input('companyName');
        $group->description = $request->description;
        $group->type = Group::TYPE_COMPANY;
        $group->save();
        if ($request->has('address')) {
            $group->setMetaValue("address", $request->input("address"));
        }
        if ($request->has('website')) {
            $group->setMetaValue("website", $request->input("website"));
        }
        if ($request->has('schedule')) {
            $group->setMetaValue("schedule", $request->input("schedule"));
        }
        if ($request->has('retailPhone')) {
            $group->setMetaValue("retailPhone", $request->input("retailPhone"));
        }
        if ($request->hasFile('retailImage')) {
            $path = MediaManager::uploadFiles($request->retailImage);
            $group->setMetaValue("retailImage", $path[0]);
        }

        return redirect()->route('admin.company.index')->with('status', 'Company created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Group::findOrFail($id);
        $users = $company->users()->get();
        return view('admin.company.show', ['company' => $company, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Group::findOrFail($id);
        $allusers = User::all();
        $users = $company->users()->get();
        return view('admin.company.edit', ['company' => $company, 'allusers' => $allusers, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'companyName' => 'required|max:100',
            'description' => 'nullable|max:250',
        ]);

        $group = Group::findOrFail($id);
        $parent_id = Group::where('title', 'Auto Dealer')->first()->id;
        $group->parent_id = $parent_id;
        $group->title = $request->input('companyName');
        $group->description = $request->description;
        $group->type = Group::TYPE_COMPANY;
        $group->save();
        if ($request->has('address')) {
            $group->setMetaValue("address", $request->input("address"));
        }
        if ($request->has('website')) {
            $group->setMetaValue("website", $request->input("website"));
        }
        if ($request->has('schedule')) {
            $group->setMetaValue("schedule", $request->input("schedule"));
        }
        if ($request->has('retailPhone')) {
            $group->setMetaValue("retailPhone", $request->input("retailPhone"));
        }
        if ($request->hasFile('retailImage')) {
            $path = MediaManager::uploadFiles($request->retailImage);
            $group->setMetaValue("retailImage", $path[0]);
        }
        $group->users()->detach();
        $users = $request->input('users');
        $usersModel = User::whereIn('id', $users)->get();
        $group->users()->saveMany($usersModel);

        return redirect()->route('admin.company.index')->with('status', 'Group edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::findOrFail($id);

        if ($group->type == Group::TYPE_COMPANY) {
            $group->delete();
            return redirect()->route('admin.company.index')->with('status', 'Company deleted');
        }
        return redirect()->route('admin.company.index')->with('status', 'This company does not exist');
    }
}
