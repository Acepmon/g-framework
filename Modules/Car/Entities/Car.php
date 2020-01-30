<?php

namespace Modules\Car\Entities;

use DB;
use App\Content;

class Car extends Content
{
    protected $fillable = [];
    protected const EXCEPT = ['minPrice', 'maxPrice', 'mileageAmount', 'options', 'carType'];

    public static function all($columns = []) {
        return Content::where('type', Content::TYPE_CAR)->where('status', Content::STATUS_PUBLISHED)->where('visibility', Content::VISIBILITY_PUBLIC);
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
                if ($value == '0') {
                    $contents = metaHas($contents, $key, $value, 'doesntHave');
                } else {
                    // $contents = metaHas($contents, $key, $value);
                    $contents = $contents->whereHas('terms', function($q) use($value) {
                        $q->where('term_taxonomy_id', $value);
                    });
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
        $request['doctorVerified'] = request('car-doctor-verified', Null);
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
    
        // $request = json_encode($request);
        return $request;
    }
}
