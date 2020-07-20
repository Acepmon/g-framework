<?php

namespace Modules\Content\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Content\Transformers\TaxonomyCollection;
use App\Entities\TaxonomyManager;
use App\TermTaxonomy;
use App\Term;
use App\Content;
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
            return new TaxonomyCollection(TaxonomyManager::getManufacturers($type, request()->input('count', False), 4));
        }

        if (request()->input('count')) {
            $taxonomies = TaxonomyManager::collection($taxonomy, True);
        } else {
            $taxonomies = TaxonomyManager::collection($taxonomy, false);
        }

        // 1. Check if mobile app is sending home parameter on Hailt
        // 14, 12
        if (request()->input('home')) {
            //$filteredIds = Car::all()->pluck('id');
            $filter = request()->all();
            $filter = array_diff_key($filter, Car::EXCEPT_FILTER);
            // dd($filter);
            $cars = Car::filterCarsByNonTermFields(Car::all(), $filter);
            foreach($filter as $key=>$value) {
                if (is_numeric($value) && $value != "1" && $value != "0") { // If value could possibly be term id
                    $cars = $cars->whereHas('terms', function ($query) use ($value) {
                        $query->where('term_taxonomy_id', $value);
                    });
                }
            }
            $filteredIds = $cars->pluck('id');
            $taxonomies = TermTaxonomy::with('term')->where('taxonomy', $taxonomy)->withCount(['contents' => function($query) use ($filteredIds) {
                $query->whereIn('id', $filteredIds);
            }])->get()->where('contents_count', '!=', '0');
            return $taxonomies;
        }
        if (request()->input('wishlist')) {
            $filtered = Content::with('terms')->where('type', 'wanna-buy')->where('status', Content::STATUS_PUBLISHED)->where('visibility', Content::VISIBILITY_PUBLIC)->get();
            $filteredIds = $filtered->pluck('id');
            $taxonomies = TermTaxonomy::with('term')->where('taxonomy', $taxonomy)->withCount(['contents' => function($query) use ($filteredIds) {
                $query->whereIn('id', $filteredIds);
            }])->get()->where('contents_count', '!=', '0');
            return $taxonomies;
        }

        return new TaxonomyCollection($taxonomies);
    }
}
