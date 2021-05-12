<?php

namespace Modules\Content\Http\Controllers\API\v1;

use DB;

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
                $taxonomies = TaxonomyController::addContentsCount($taxonomy, Term::where($type, True))->get();
                $top5 = clone $taxonomies;
                $top5Names = ['Toyota', 'Lexus', 'Nissan', 'Hyundai'];// Mercedes-Benz, 
                $top5 = $top5->whereIn('term.name', $top5Names);
                $top5 = $top5->sortBy(function($model) use ($top5Names) {
                    return array_search($model->term->name, $top5Names);
                });
                $taxonomies = $top5->merge($taxonomies);
                return new TaxonomyCollection($taxonomies);
            }
            $taxonomies = TaxonomyController::addContentsCount($taxonomy, TaxonomyManager::getManufacturers($type, request()->input('count', False), 4))->get()->where('contents_count', '!=', '0');
            return new TaxonomyCollection($taxonomies);
        }

        if (request()->input('count')) {
            $taxonomies = TaxonomyManager::collection($taxonomy, True);
        } else {
            $taxonomies = TaxonomyManager::collection($taxonomy, false);
        }

        if (request()->input('home')) {
            $filteredIds = Car::all()->pluck('id');
            $taxonomies = TermTaxonomy::with('term')->where('taxonomy', $taxonomy)->withCount(['term_relationships as contents_count' => function($query) use ($filteredIds) {
                $query->whereIn('content_id', $filteredIds);
                $query->select(DB::raw('count(distinct(`content_id`))'));
            }])->get()->where('contents_count', '!=', '0');
            return $taxonomies;
        }
        if (request()->input('wishlist')) {
            $filtered = Content::with('terms')->where('type', 'wanna-buy')->where('status', Content::STATUS_PUBLISHED)->where('visibility', Content::VISIBILITY_PUBLIC)->get();
            $filteredIds = $filtered->pluck('id');
            $taxonomies = TermTaxonomy::with('term')->where('taxonomy', $taxonomy)->withCount(['term_relationships as contents_count' => function($query) use ($filteredIds) {
                $query->whereIn('content_id', $filteredIds);
                $query->select(DB::raw('count(distinct(`content_id`))'));
            }])->get()->where('contents_count', '!=', '0');
            return $taxonomies;
        }

        $taxonomies = TaxonomyController::addContentsCount($taxonomy, $taxonomies)->get();
        if (request()->input('count')) {
            $taxonomies = $taxonomies->where('contents_count', '!=', 0)->values();
        }
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
        $taxonomies = TermTaxonomy::with('term')->where('taxonomy', $taxonomy)->whereIn('id', $taxonomies->pluck('id'))->withCount(['term_relationships as contents_count' => function($query) use ($filteredIds) {
            $query->whereIn('content_id', $filteredIds);
            $query->select(DB::raw('count(distinct(`content_id`))'));
        }]);//->where('contents_count', '!=', '0');
        if (request()->input('order') == 'contents_count') {
            $taxonomies = $taxonomies->orderByDesc("contents_count");
        }
        // $taxonomies = $taxonomies->get();
        return $taxonomies;
    }

    public function car()
    {
        return [
            'car-advance-payments' => new TaxonomyCollection(TaxonomyManager::collection('car-advance-payments')),
            'car-type' => new TaxonomyCollection(TaxonomyManager::collection('car-type')),
            'car-conditions' => new TaxonomyCollection(TaxonomyManager::collection('car-conditions')),
            'car-colors' => new TaxonomyCollection(TaxonomyManager::collection('car-colors')),
            'car-transmission' => new TaxonomyCollection(TaxonomyManager::collection('car-transmission')),
            'car-mancount' => new TaxonomyCollection(TaxonomyManager::collection('car-mancount')),
            'provinces' => new TaxonomyCollection(TaxonomyManager::collection('provinces')),
            'car-advantages' => new TaxonomyCollection(TaxonomyManager::collection('car-advantages')),
            'best_premium' => new TaxonomyCollection(TaxonomyManager::collection('best_premium')),
            'premium' => new TaxonomyCollection(TaxonomyManager::collection('premium')),
            'car-options' => new TaxonomyCollection(TaxonomyManager::collection('car-options')),
            'car-fuel' => new TaxonomyCollection(TaxonomyManager::collection('car-fuel')),
            'car-wheel' => new TaxonomyCollection(TaxonomyManager::collection('car-wheel')),
            'car-wheel-pos' => new TaxonomyCollection(TaxonomyManager::collection('car-wheel-pos')),
            'car-exterior' => new TaxonomyCollection(TaxonomyManager::collection('car-exterior')),
            'car-guts' => new TaxonomyCollection(TaxonomyManager::collection('car-guts')),
            'car-safety' => new TaxonomyCollection(TaxonomyManager::collection('car-safety')),
            'car-convenience' => new TaxonomyCollection(TaxonomyManager::collection('car-convenience'))
        ];
    }
}
