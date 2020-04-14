<?php

namespace Modules\Car\Http\Controllers\Ajax;

use DB;
use App\Term;
use App\TermTaxonomy;
use App\Entities\TaxonomyManager;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Car\Entities\Car;

class CarController extends Controller
{
    const CATEGORY_SLUG = [
        'car-type', 'car-manufacturer', 'car-colors', 'car-fuel', 'car-transmission', 'car-mancount', 
        'car-wheel-pos', 'provinces', 'car-seller', 'car-doctor-verified', 'car-manufacturer',
        'car-exterior', 'car-guts', 'car-safety', 'car-convenience'
        ];
    const ARRAY_INPUTS = ['car-exterior', 'car-guts', 'car-safety', 'car-convenience'];

    public function count()
    {
        $filter = request()->all();
        $cars = Car::filterCarsByNonTermFields(Car::all(), $filter);
        $categories = self::CATEGORY_SLUG; // Return counts of these taxonomies
        $models = array();
        if (array_key_exists('countables', $filter)) { // Also add optional models. This is dynamic loading, because loading count of all models will be performance heavy.
            $models = $filter['countables'];
        }
        $categories = array_unique(array_merge($categories, $models));
        $filter = array_diff_key($filter, Car::EXCEPT_FILTER);

        $taxonomies = collect();
        foreach ($categories as $filterKey) {
            $filtered = clone $cars;//Car::all();
            foreach ($filter as $key => $value) {
                if ($key != $filterKey // Filter all except current category. So that other options in current category count won't just appear as 0.
                    // && !($filterKey == 'car-manufacturer' && in_array($key, $models))) {// If it's manufacturers, also don't filter by models
                    && !(in_array($key, $models))) {// If it's manufacturers, also don't filter by models
                    if (in_array($key, self::ARRAY_INPUTS)) { // If this filtering can take multiple inputs [such as options]
                        foreach ($value as $id) {
                            $filtered = $filtered->whereHas('terms', function ($query) use ($id) {
                                $query->where('term_taxonomy_id', $id);
                            });
                        }
                    } else if (is_numeric($value) && $value != "1" && $value != "0") { // If value could possibly be term id
                        $filtered = $filtered->whereHas('terms', function ($query) use ($value) {
                            $query->where('term_taxonomy_id', $value);
                        });
                    }
                }
            }
            $filteredIds = $filtered->pluck('id');
            $taxonomiesFiltered = TermTaxonomy::where('taxonomy', $filterKey);
            $taxonomiesFiltered = $taxonomiesFiltered->withCount(['contents' => function($query) use ($filteredIds) {
                $query->whereIn('id', $filteredIds);
            }])->get();
            $taxonomies = $taxonomies->merge($taxonomiesFiltered);
        }

        return $taxonomies;
    }

    public function filter()
    {
        $filter = request()->all();
        foreach ($filter as $key => $value) {
            if (!$value) {
                unset($filter[$key]);
            }
        }
        $cars = Car::all();

        $type = 'buy';
        $search = '';
        if (array_key_exists('search', $filter) && $filter['search'] != '') {
            $type = 'search';
            $search = $filter['search'];
        }
        if (array_key_exists('advantage', $filter) && $filter['advantage'] != '') {
            $type = 'search';
        }
        $cars = Car::filterCarsByRequest($cars, $filter);

        // Ordering by premium
        $orderBy = request('orderBy', 'publishedAt');
        $cars = $cars->orderBy('order', 'desc');
        $cars = Car::order($orderBy, 'desc', $cars);

        $page = request('page', 1);
        $perPage = 15;
        $cars = $cars->paginate();
        return view('themes.car-web.includes.car-list-contents', [
            'items' => $cars, 
            'type' => $type,
            'search' => $search,
            'orderBy' => $orderBy,// TODO: refactor
            'page' => $page,
            'itemsPerPage' => $perPage,
            'maxPage' => $cars->lastPage(),
            'publishType' =>  Null
            ]);
    }

    public function getTaxonomy($taxonomy) {
        $count = request('count', False);
        $type = request('type', '');
        if ($taxonomy == 'car-manufacturer') {
            $type = request('type', '');
        }

        $taxonomies = TermTaxonomy::where('taxonomy', $taxonomy);
        if ($type != '') {
            $terms_id = Term::where($type, True)->pluck('id');
            $taxonomies = $taxonomies->whereIn('term_id', $terms_id);
        }

        $filter = request()->all();
        $filter = array_diff_key($filter, Car::EXCEPT_FILTER);
        $filtered = Car::all();
        if (array_key_exists('manufacturer-id', $filter)) {
            $filtered = Car::filterCarsByRequest($filtered, $filter);
        }
        $filteredIds = $filtered->pluck('id');

        $taxonomies = $taxonomies->withCount(['contents' => function($query) use ($filteredIds) {
            $query->whereIn('id', $filteredIds);
        }]);
        $taxonomies = $taxonomies->get();
        
        if ($count) {
            $taxonomies = $taxonomies->where('contents_count', '!=', 0);
        }
        $order = request('order', '');
        if ($order == "top-5") {
            // <<< Take most common 5 manufacturers and order other by id
            $taxonomies = $taxonomies->sortByDesc('contents_count');
            $firstFive = $taxonomies->take(5);
            $taxonomies = $taxonomies->slice(5)->sortBy('id');
            $taxonomies = $firstFive->merge($taxonomies);
        } else if ($order == "count") {
            $taxonomies = $taxonomies->sortByDesc('contents_count');
        } else if ($order == "name") {
            $taxonomies = $taxonomies->sortBy('term.name');
            $taxonomies = $taxonomies->where('contents_count', '!=', 0);
        }

        return view('themes.car-web.includes.car-list-menu-items', [
            'taxonomies' => $taxonomies,
            'name' => $taxonomy,
            'container' => ($taxonomy=='car-manufacturer')?$taxonomy:'models'
        ]);
    }
}
