<?php

namespace App\Entities;

use DB;
use App\Content;
use App\ContentMeta;
use App\TermTaxonomy;
use App\Term;
use App\TermMeta;
use Modules\Car\Entities\Car;
use Modules\Content\Transformers\TaxonomyCollection;

class TaxonomyManager extends Manager
{
    /**
     * Creates or modifies a taxonomy object.
     *
     * @parameter $term  = (string) (Required) Term name, it is the default display name.
     * @parameter $taxonomy = (string) (Required) Taxonomy key, must not exceed 32 characters.
     * @parameter $parent_id = (integer) (Optional) Taxonomy parent taxonomy key.
     * @parameter $args = (array|string) (Optional) Array or query string of arguments for registering a taxonomy.
     */
    public static function register($term, $taxonomy, $parent_id = null, $args = array(), $other_columns = array(), $slug = null)
    {
        $termTaxonomy = TermTaxonomy::where('taxonomy', $taxonomy)->whereHas('term', function ($query) use ($term) {
            $query->where('name', $term);
        })->first();

        if ($termTaxonomy == null) {
            $normal = array_key_exists('normal', $other_columns)?$other_columns['normal']:False;
            $bus = array_key_exists('bus', $other_columns)?$other_columns['bus']:False;
            $truck = array_key_exists('truck', $other_columns)?$other_columns['truck']:False;
            $special = array_key_exists('special', $other_columns)?$other_columns['special']:False;
            $term = self::createTerm($term, $parent_id, $normal, $bus, $truck, $special, $slug);
            self::saveTermMetas($term->id, $args);
            $termTaxonomy = self::createTaxonomy($term->id, $taxonomy, $parent_id);
        }

        return $termTaxonomy;
    }

    public static function collection($taxonomy, $count = False)
    {
        if ($count) {
            return TermTaxonomy::where('taxonomy', $taxonomy)->get()->where('contents_count', '!=', '0');
        }
        $taxonomies = TermTaxonomy::where('taxonomy', $taxonomy)->get();//->orderBy('taxonomy', 'ASC');
        return $taxonomies;
    }

    public static function createTerm($name, $group_id = null, $normal = False, $bus = False, $truck = False, $special = False, $slug = null)
    {
        $term = new Term();
        $term->name = $name;
        $term->slug = $slug?$slug:\Str::slug($name);
        $term->group_id = $group_id;
        $term->normal = $normal;
        $term->bus = $bus;
        $term->truck = $truck;
        $term->special = $special;
        $term->save();

        return $term;
    }

    public static function createTaxonomy($term_id, $taxonomy, $parent_id = null, $description = null)
    {
        $termTaxonomy = new TermTaxonomy();
        $termTaxonomy->term_id = $term_id;
        $termTaxonomy->taxonomy = strtolower($taxonomy);
        $termTaxonomy->parent_id = $parent_id;
        $termTaxonomy->description = $description;
        $termTaxonomy->count = 0;
        $termTaxonomy->save();

        return $termTaxonomy;
    }

    public static function saveTermMetas($term_id, $metas = array())
    {
        $term = Term::findOrFail($term_id);

        if (count($metas) > 0) {
            foreach ($metas as $key => $value) {
                $term->metas()->save(new TermMeta(['key' => $key, 'value' => $value]));
            }
        }

        return $term->metas;
    }

    public static function updateTaxonomyCount($taxonomy_id)
    {
        $termTaxonomy = TermTaxonomy::findOrFail($taxonomy_id);
        $termTaxonomy->count = max($termTaxonomy->contents->count(), 0);
        $termTaxonomy->save();
    }

    public static function updateTaxonomyChildrenSlugs($taxonomy_id)
    {
        $parent = TermTaxonomy::findOrFail($taxonomy_id);
        $childs = TermTaxonomy::where('parent_id', $taxonomy_id)->get();
        foreach ($childs as $key => $child) {
            $term = $child->term;
            $term->slug = $parent->term->slug . '/' . $term->slug;
            $term->save();
        }
    }

    public static function findTerm($term)
    {
        $term = Term::where('name', $term)->firstOrFail();
        return $term;
    }

    public static function findTaxonomy($taxonomy)
    {
        $taxonomy = TermTaxonomy::where('taxonomy', $taxonomy)->firstOrFail();
        return $taxonomy;
    }

    public static function incrementCount($key, $value)
    {
        $term = Term::where('name', $value)->first();
        if ($term && $term->group && $key == $term->group->metaValue('metaKey') && $term->taxonomy) {
            $term->taxonomy->increment('count');
            $term->taxonomy->save();
        } else if ($value == '1' || $value == '0') {
            // This is used in Options
            $term_meta = TermMeta::where('value', $key)->first();
            if ($term_meta) {
                $term = $term_meta->term;
                $term->taxonomy->increment('count');
                $term->taxonomy->save();
            }
        }
    }

    public static function decrementCount($key, $value)
    {
        $term = Term::where('name', $value)->first();
        if ($term && $term->group && $key == $term->group->metaValue('metaKey') && $term->taxonomy) {
            $term->taxonomy->decrement('count');
            $term->taxonomy->save();
        } else if ($value == '1' || $value == '0') {
            $term_meta = TermMeta::where('value', $key)->first();
            if ($term_meta) {
                $term = $term_meta->term;
                $term->taxonomy->decrement('count');
                $term->taxonomy->save();
            }
        }
    }

    public static function recount($key, $value)
    {
        
    }

    public static function getValue($id) {
        if (!$id)
            return $id;
        $value = Term::where('id', $id)->first();
        if ($value) {
            if ($value->metaValue('value')) {
                return $value->metaValue('value');
            } else {
                return $value->name;
            }
        }
        return $id;
    }


    /*
    * returns top 5 manufacturer with most content on top
    */
    public static function getManufacturers($type='normal', $count=True, $limit = 5)
    {
        $terms_id = Term::where($type, True)->pluck('id');
        if ($count) {
            $filteredIds = Car::all()->pluck('id');
            $manufacturers = TermTaxonomy::where([['taxonomy', 'car-manufacturer']])->whereIn('term_id', $terms_id)->withCount(['term_relationships as contents_count' => function($query) use ($filteredIds) {
                $query->whereIn('content_id', $filteredIds);
                $query->select(DB::raw('count(distinct(`content_id`))'));
            }]);
            $most = clone $manufacturers;
            $most = $most->orderBy('contents_count', 'desc')->limit($limit);
            
            $manufacturers = $manufacturers->get()->sortBy('term.name')->where('contents_count', '!=', '0');
            $most = $most->get()->merge($manufacturers);
            return $most;
        } else {
            $manufacturers = TermTaxonomy::where('taxonomy', 'car-manufacturer')->whereIn('term_id', $terms_id);
        }
        $most = clone $manufacturers;
        $most = $most->orderBy('count', 'desc')->limit($limit);
        $most = $most->get()->merge($manufacturers->get());
        return $most;
    }
    
    public static function getWishlistManufacturers($limit=5)
    {
        $taxonomies = TermTaxonomy::where('taxonomy', 'car-manufacturer');
        $filtered = Content::with('terms')->where('type', 'wanna-buy')->where('status', Content::STATUS_PUBLISHED)->where('visibility', Content::VISIBILITY_PUBLIC)->get();
        $filteredIds = $filtered->pluck('id');

        $taxonomies = $taxonomies->withCount(['term_relationships as contents_count' => function($query) use ($filteredIds) {
            $query->whereIn('content_id', $filteredIds);
            $query->select(DB::raw('count(distinct(`content_id`))'));
        }])->get()->where('contents_count', '!=', '0');

        $most = clone $taxonomies;
        $most = $most->sortByDesc('contents_count', -1)->take($limit);
        $most = $most->merge($taxonomies->sortBy('term.name'));
        return $most;
    }
}
