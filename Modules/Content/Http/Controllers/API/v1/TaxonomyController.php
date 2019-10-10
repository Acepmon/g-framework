<?php

namespace Modules\Content\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Content\Transformers\TaxonomyCollection;

use App\Entities\TaxonomyManager;
use App\TermTaxonomy;

class TaxonomyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return new TaxonomyCollection(TermTaxonomy::all());
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($taxonomy)
    {
        return new TaxonomyCollection(TaxonomyManager::collection($taxonomy));
    }
}