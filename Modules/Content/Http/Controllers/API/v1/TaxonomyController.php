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
                $taxonomies = TermTaxonomy::join('terms', 'terms.id', '=', 'term_taxonomy.term_id')->where('taxonomy', 'car-manufacturer')->whereIn('term_id', $terms_id);
                $top5 = clone $taxonomies;
                // Mercedes-Benz, 
                $top5 = $top5->whereIn('name', ['Toyota', 'Lexus', 'Nissan', 'Hyundai'])->get();
                $taxonomies = $top5->merge($taxonomies->orderBy('name')->get());
                return new TaxonomyCollection($taxonomies);
            }
            $taxonomies = TaxonomyController::addContentsCount($taxonomy, TaxonomyManager::getManufacturers($type, request()->input('count', False), 4));
            return new TaxonomyCollection($taxonomies);
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
        if (request()->input('wishlist')) {
            $filtered = Content::with('terms')->where('type', 'wanna-buy')->where('status', Content::STATUS_PUBLISHED)->where('visibility', Content::VISIBILITY_PUBLIC)->get();
            $filteredIds = $filtered->pluck('id');
            $taxonomies = TermTaxonomy::with('term')->where('taxonomy', $taxonomy)->withCount(['contents' => function($query) use ($filteredIds) {
                $query->whereIn('id', $filteredIds);
            }])->get()->where('contents_count', '!=', '0');
            return $taxonomies;
        }

        $taxonomies = TaxonomyController::addContentsCount($taxonomy, $taxonomies);
        if (request()->input('sort')) {
            return response()->json(array_values($taxonomies->sortBy('term.name', SORT_NATURAL|SORT_FLAG_CASE)->toArray()));
        }
        return new TaxonomyCollection($taxonomies);
    }

    public static function addContentsCount($taxonomy, $taxonomies) {
        $filter = request()->all();
        // dd($filter);
        $cars = Car::filterCarsByNonTermFields(Car::all(), $filter);
        $filter = array_diff_key($filter, Car::EXCEPT_FILTER);
        foreach($filter as $key=>$value) {
            if (is_numeric($value) && $value != "1" && $value != "0") { // If value could possibly be term id
                $cars = $cars->whereHas('terms', function ($query) use ($value) {
                    $query->where('term_taxonomy_id', $value);
                });
            }
        }
        $filteredIds = $cars->pluck('id');
        $taxonomies = TermTaxonomy::with('term')->where('taxonomy', $taxonomy)->whereIn('id', $taxonomies->pluck('id'))->withCount(['contents' => function($query) use ($filteredIds) {
            $query->whereIn('id', $filteredIds);
        }])->get();//->where('contents_count', '!=', '0');
        return $taxonomies;
    }
}
