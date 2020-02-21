<?php

namespace Modules\Content\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Content\Transformers\TaxonomyCollection;
use App\Entities\TaxonomyManager;
use App\TermTaxonomy;
use App\Term;
use Modules\Car\Entities\Car;

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
        if ($taxonomy == 'car-manufacturer') {
            $type = request('type', 'normal');
            if (request('sort', False)) {
                $terms_id = Term::where($type, True)->pluck('id');
                return new TaxonomyCollection(TermTaxonomy::join('terms', 'terms.id', '=', 'term_taxonomy.term_id')->where('taxonomy', 'car-manufacturer')->whereIn('term_id', $terms_id)->orderBy('name')->get());
            }
            return new TaxonomyCollection(TaxonomyManager::getManufacturers($type, request()->input('count', request()->input('count')?True:False)));
        }
        if (request()->input('count')) {
            $taxonomies = TaxonomyManager::collection($taxonomy, True);
        } else {
            $taxonomies = TaxonomyManager::collection($taxonomy, false);
        }

        if (request()->input('home')) {
            $filteredIds = Car::all()->pluck('id');
            $taxonomies = TermTaxonomy::with('term')->where('taxonomy', $taxonomy)->withCount(['contents' => function($query) use ($filteredIds) {
                $query->whereIn('id', $filteredIds);
            }])->get()->where('contents_count', '!=', '0');
            return $taxonomies;
        }

        return new TaxonomyCollection($taxonomies);
    }
}
