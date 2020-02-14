<?php

namespace Modules\Car\Entities;

use DB;
use App\Content;
use App\User;

class Car extends Content
{
    protected $fillable = [];
    protected const EXCEPT = ['minPrice', 'maxPrice', 'mileageAmount', 'options', 'carType', 'seller'];

    public static function all($columns = []) {
        return Content::with('terms')->where('type', Content::TYPE_CAR)->where('status', Content::STATUS_PUBLISHED)->where('visibility', Content::VISIBILITY_PUBLIC);
    }

    public static function order($orderBy, $order, $contents = Null) {
        if ($contents == Null) {
            $contents = self::all();
        }
        if ($orderBy != 'updated_at') {
            $contents = $contents->leftJoin('content_metas', function($join) use($orderBy) {
                $join->on('contents.id', '=', 'content_metas.content_id');
                $join->where('content_metas.key', '=', $orderBy);
            });
            $contents = $contents->select('contents.*', DB::raw('IFNULL(content_metas.value, "0") as value'));//->addSelect('content_metas.value');
            if ($orderBy == 'priceAmount') {
                $order = 'asc';
                $contents = $contents->orderByRaw('LENGTH(value)', $order);
            }
            $contents = $contents->orderBy('value', $order);
        } else {
            $contents = $contents->orderBy($orderBy, $order);
        }
        return $contents;
    }

    public static function filter($contents, $filter = Null, $exclude = Null) {
        if ($contents == Null) {
            $contents = self::all()->orderBy('created_at', 'desc');
        }

        foreach ($filter as $key => $value) {
            if ($key != $exclude && $value != Null && !in_array($key, self::EXCEPT)) {
                if ($value == '-1') {
                    $contents = metaHas($contents, $key, $value, 'doesntHave');
                } else {
                    if (is_numeric($value) && $value != "1" && $value != "0") {
                        $contents = $contents->whereHas('terms', function($q) use($value) {
                            $q->where('term_taxonomy_id', $value);
                        });
                    } else {
                        $contents = metaHas($contents, $key, $value);
                    }
                }
            }
        }

        if (array_key_exists('options', $filter)) {
            foreach($filter['options'] as $key => $value) {
                $contents = metaHas($contents, $value, '1');
            }
        }
        $minPrice = Null;
        $maxPrice = Null;
        if (array_key_exists('minPrice', $filter)) {
            $minPrice = $filter['minPrice'];
        }
        if (array_key_exists('maxPrice', $filter)) {
            $maxPrice = $filter['maxPrice'];
        }
        if ($minPrice || $maxPrice) {
            $contents = metaHas($contents, 'priceAmount', '', 'range', $minPrice, $maxPrice);
        }

        if (array_key_exists('mileageAmount', $filter)) {
            $mileage = $filter['mileageAmount'];
            if ($mileage) {
                [$minMileage, $maxMileage] = explode('-', $mileage);
                $contents = metaHas($contents, 'mileageAmount', '', 'range', $minMileage, $maxMileage);
            }
        }

        if (array_key_exists('seller', $filter) && $filter['seller'] != 0) {
            $dealers = User::whereHas('groups', function ($query) {
                $query->where('id', 9)->orWhere('parent_id', 9);
            })->pluck('id');
            if ($filter['seller'] == 'individual') {
                $contents = $contents->whereNotIn('author_id', $dealers);
            } else if ($filter['seller'] == 'dealer') {
                $contents = $contents->whereIn('author_id', $dealers);
            }
        }

        return $contents;
    }

    public static function filterByPremium($limit = Null, $contents = Null, $publishType = Null) {
        $now = now();
        $filtered = $contents;
        if ($filtered == Null) {
            $filtered = self::all()->orderBy('created_at', 'desc');
        }
        $filtered = metaHas($filtered, 'publishVerified', True);
        $filtered = $filtered->whereHas('metas', function ($query) use ($now) {
            $query->where([['key', 'publishVerifiedEnd'],['value','>=',$now]]);
        });

        // >>>>>>>>>>>> USE THIS
        // $premium = metaHas(clone $filtered, 'publishType', 'premium')->get();
        // $best_premium = metaHas(clone $filtered, 'publishType', 'best_premium')->get();
        // $filtered = $best_premium->push($premium);
        // <<<<<<<<<<<< OR THIS
        $filtered = $filtered->whereHas('metas', function ($query) use($publishType) {
            $query->where('key', 'publishType');
            //$query->whereIn('value', 'best_premium')->orWhere('value', 'premium');
            if ($publishType != Null) {
                $query->where('value', $publishType);
            } else {
                $query->whereIn('value', ['best_premium', 'premium']);
            }
            // $query->where('value', 'premium');
        });

        if ($limit) {
            $filtered = $filtered->paginate($limit);
        }
        // dd($filtered->get());
        return $filtered;
    }

    /*
    * Converts GET request paramaters to content_meta object array
    * Used in car lists
    */
    public static function manageRequest() {
        $request = [];
        $request['carType'] = request('car-type', Null);
        $request['markName'] = request('car-manufacturer', Null);
        $request['modelName'] = request('car-model', Null);
        $request['colorName'] = request('car-colors', Null);
        $request['fuelType'] = request('car-fuel', Null);
        $request['transmission'] = request('car-transmission', Null);
        $request['options'] = request('car-options', []);
        $request['advantages'] = request('car-advantage', Null);
        $request['manCount'] = request('car-mancount', Null);
        $request['wheelPosition'] = request('car-wheel-pos', Null);
        $request['countryName'] = request('provinces', Null);
        $request['buildYear'] = request('buildYear', Null);
        $request['importDate'] = request('importDate', Null);
        $request['mileageAmount'] = request('mileageAmount', Null);
        $request['publishType'] = request('publishType', Null);
        $request['minPrice'] = request('min_price', Null);
        $request['maxPrice'] = request('max_price', Null);
        
        $request['carSubType'] = Null;
        if ($request['carType'] == 'Хүнд ММ') {
            $request['carSubType'] = request('truck-size', Null);
        } else if ($request['carType'] == 'Автобус') {
            $request['carSubType'] = request('bus-sizes', Null);
        } else if ($request['carType'] == 'Тусгай ММ') {
            $request['carSubType'] = request('special', Null);
        }
        $request['doctorVerified'] = request('car-doctor-verified', 0);
        $request['seller'] = request('car-seller', 0);
        $request['isAuction'] = request('isAuction', Null);

        $request['min_mileageAmount'] = request('min_mileageAmount', Null);
        $request['max_mileageAmount'] = request('max_mileageAmount', Null);
        
        // $request = json_encode($request);
        return $request;
    }

    public const EXCEPT_FILTER = ['orderBy'=>'', 'page'=>'', 'except'=>'', 'countables'=>'',
        'minBuildYear'=>'', 'maxBuildYear'=>'', 'minImportDate'=>'', 'maxImportDate'=>'',
        'minPriceAmount'=>'', 'maxPriceAmount'=>'', 'minMileageAmount'=>'', 'maxMileageAmount'=>'',
        'publishType'=>'', 'advantage'=>''
    ];
    public static function filterCarsByRequest($cars, $filter) {
        // TODO: possibly change method name. Used in CarController
        $cars = self::filterCarsByNonTermFields($cars, $filter);

        // Term Filters
        $filter = array_diff_key($filter, SELF::EXCEPT_FILTER);
        foreach ($filter as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $optionId) {
                    $cars = $cars->whereHas('terms', function ($query) use ($optionId) {
                        $query->where('term_taxonomy_id', $optionId);
                    });
                }
            } else {
                $cars = $cars->whereHas('terms', function ($query) use ($value) {
                    if (is_numeric($value) && $value != "1" && $value != "0") {
                        $query->where('term_taxonomy_id', $value);
                    }
                });
            }
        }

        return $cars;
    }

    public static function filterCarsByNonTermFields($cars, $filter) {
        // Custom Filters
        if (array_key_exists('publishType', $filter) && $filter['publishType'] != '') {
            $publishType = 1;
            if ($filter['publishType'] == 'premium') {
                $publishType = 2;
            } else if ($filter['publishType'] == 'best_premium') {
                $publishType = 3;
            }
            $cars = $cars->where('order', $publishType);
        }
        if (array_key_exists('search', $filter) && $filter['search'] != '') {
            $cars = $cars->where('title', 'LIKE', '%'.$filter['search'].'%');
        }
        if (array_key_exists('except', $filter) && $filter['except'] != '') {
            $cars = $cars->where('contents.id', '!=', $filter['except']);
        }
        if (array_key_exists('advantage', $filter) && $filter['advantage'] != '') {
            $advantages = $filter['advantage'];
            foreach ($advantages as $advantage) {
                $cars = $cars->whereHas('metas', function($query) use($advantage) {
                    $query->where('key', 'advantages');
                    $query->where('value', $advantage);
                });
            }
        }
        $cars = self::filterCustom($cars, $filter, 'minBuildYear', 'buildYear', '>=');
        $cars = self::filterCustom($cars, $filter, 'maxBuildYear', 'buildYear', '<=');
        $cars = self::filterCustom($cars, $filter, 'minImportDate', 'importDate', '>=');
        $cars = self::filterCustom($cars, $filter, 'maxImportDate', 'importDate', '<=');
        $cars = self::filterCustom($cars, $filter, 'minMileageAmount', 'mileageAmount', '>=');
        $cars = self::filterCustom($cars, $filter, 'maxMileageAmount', 'mileageAmount', '<=');
        $cars = self::filterCustom($cars, $filter, 'minPriceAmount', 'priceAmount', '>=');
        $cars = self::filterCustom($cars, $filter, 'maxPriceAmount', 'priceAmount', '<=');
        return $cars;
    }

    public static function filterCustom($cars, $filter, $key, $metaKey, $operator='=') {
        if (array_key_exists($key, $filter) && $filter[$key] != '') {
            $value = $filter[$key];
            $cars = $cars->whereHas('metas', function($query) use($metaKey, $value, $operator) {
                $query->where('key', $metaKey);
                if ($operator == '=') {
                    $query->where('value', $value);
                } else if (in_array($operator, ['>', '<', '<=', '>='])) {
                    $query->whereRAW('cast(value as unsigned) ' . $operator . ' '. $value);
                }
            });
        }
        return $cars;
    }
}
