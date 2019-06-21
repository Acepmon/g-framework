<?php

namespace App\Http\Controllers\Admin;

use App\Term;
use App\TermTaxonomy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class TaxonomyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $taxonomy = Input::get('taxonomy', '');
        if ($taxonomy == '') {
            $taxonomy = session('taxonomy');
        }
        session(['taxonomy' => $taxonomy]);
        $term_taxonomies = TermTaxonomy::where('taxonomy', $taxonomy)->get();
        return view('admin.taxonomy.index', ['term_taxonomies' => $term_taxonomies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.taxonomy.create');
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
        $validatedData = $request->validate([
            'name' => 'required|max:191',
            'slug' => 'required|max:191',
        ]);
        try {
            DB::beginTransaction();

            $term = new Term();
            $term->name = $request->input('name');
            $term->slug = $request->input('slug');
            $term->group_id = $request->input('group_id');
            $term->save();

            $term_taxonomy = new TermTaxonomy();
            $term_taxonomy->term_id = $term->id;
            $term_taxonomy->taxonomy = session('taxonomy');
            $term_taxonomy->description = $request->input('description');
            $term_taxonomy->parent_id = $request->input('parent_id');
            $term_taxonomy->count = 0;
            $term_taxonomy->save();

            DB::commit();
            return redirect()->route('admin.taxonomy.create')->with('success', 'Successfully registered!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.taxonomy.create')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $term_taxonomy = TermTaxonomy::findOrFail($id);
        return view('admin.taxonomy.show', ['term_taxonomy' => $term_taxonomy]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $term_taxonomy = TermTaxonomy::findOrFail($id);
        return view('admin.taxonomy.edit', ['term_taxonomy' => $term_taxonomy]);
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
        //
        $term_taxonomy = TermTaxonomy::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|max:191',
            'slug' => 'required|max:191',
        ]);
        try {
            DB::beginTransaction();

            $term_taxonomy->description = $request->input('description');
            $term_taxonomy->parent_id = $request->input('parent_id');
            $term_taxonomy->term->name = $request->input('name');
            $term_taxonomy->term->slug = $request->input('slug');
            $term_taxonomy->term->group_id = $request->input('group_id');
            $term_taxonomy->term->save();
            $term_taxonomy->save();

            DB::commit();
            return redirect()->route('admin.taxonomy.edit', ['term_taxonomy' => $term_taxonomy])->with('success', 'Successfully registered!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.taxonomy.edit', ['term_taxonomy' => $term_taxonomy])->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $term_taxonomy = TermTaxonomy::findOrFail($id);
        TermTaxonomy::destroy($id);
        // Term::destroy($term_taxonomy->term->id);
        return redirect()->route('admin.taxonomy.index');
    }
}
