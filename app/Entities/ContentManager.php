<?php

namespace App\Entities;

use App\Content;
use App\ContentMeta;
use App\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Payment\Entities\Transaction;
use Modules\Content\Transformers\Content as ContentResource;


class ContentManager extends Manager
{
    //
    const TERM_KEYS = ['carSubType']; // These keys should be filtered by term_relationships

    /**
     * Inserts meta to content
     * Does not care about if key exists or not
     * Can support array as value
     */
    public static function addMeta($content_id, $key, $value)
    {
        if ($value) {
            if (is_array($value)) {
                foreach ($value as $v) {
                    self::addMeta($content_id, $key, $v);
                }
            } else {
                $meta = new ContentMeta;
                $meta->content_id = $content_id;
                $meta->key = $key;
                $meta->value = $value;
                $meta->save();
            }
        }
    }

    /**
     * @parameter value = Old Value
     * @paremeter newValue = New value
     * Updates all metas matching key, value pair
     * @return meta if successful, error message if fail
     */
    public static function updateMeta($content_id, $key, $value, $newValue)
    {
        if ($newValue != Null) {
            $metas = ContentMeta::where([['content_id', $content_id], ['key', $key], ['value', $value]])->get();
            $result = null;
            foreach ($metas as $meta) {
                if ($meta) {
                    if (is_array($newValue)) {
                        $meta->delete();
                        self::addMeta($content_id, $key, $newValue);
                    } else {
                        $meta->value = $newValue;
                        $meta->save();
                    }
                    $result = $meta;
                }
            }
            if ($result) {
                return $result;
            }

        }
        return ["error" => "No such meta found"];
    }

    /**
     * Deletas ALL content meta
     * @return meta if successful, error message if fail
     */
    public static function deleteMeta($content_id, $key, $value)
    {
        if ($value) {
            if (is_array($value)) {
                foreach ($value as $v) {
                    self::deleteMeta($content_id, $key, $v);
                }
            } else {
                $metas = ContentMeta::where([['content_id', $content_id], ['key', $key], ['value', $value]])->get();
                if ($key == 'medias') {
                    foreach($metas as $meta) {
                        $filepath = $meta->value;
                        $filepath = substr($filepath, strpos($filepath, "public/"));
                        Storage::disk('ftp')->delete($filepath[0]);
                        $meta->delete();
                    }
                } else {
                    $metas->each->delete();
                }
            }
        }
    }

    /**
     * Sync content metas
     * @input array of meta key, value pairs
     * Replace all values
     * @return meta if successful, error message if fail
     */
    public static function syncMetas($content_id, $metas)
    {
        try {
            DB::beginTransaction();
            foreach ($metas as $key => $value) {
                $oldMetas = ContentMeta::where([['content_id', $content_id], ['key', $key]]);
                if (is_array($value)) {
                    foreach ($oldMetas->get() as $meta) {
                        if (in_array($meta->value, $value)) {
                            $value = array_diff($value, [$meta->value]);
                        } else {
                            self::deleteMeta($content_id, $key, $meta->value);
                        }
                    }
                    foreach ($value as $v) {
                        self::addMeta($content_id, $key, $v);
                    }
                } else {
                    if ($oldMetas->first()) {
                        self::updateMeta($content_id, $key, $oldMetas->first()->value, $value);
                    } else {
                        self::addMeta($content_id, $key, $value);
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Mass add metas
     */
    public static function attachMetas($content_id, $metas)
    {
        try {
            DB::beginTransaction();
            foreach ($metas as $key => $value) {
                self::addMeta($content_id, $key, $value);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Mass delete metas
     */
    public static function detachMetas($content_id, $metas)
    {
        try {
            DB::beginTransaction();
            foreach ($metas as $key => $value) {
                if (is_array($value)) {
                    self::deleteMeta($content_id, $key, $value);

                } else {
                    self::deleteMeta($content_id, $key, $value);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public static function filterByRequest(Request $request, $author_id = null)
    {
        $type = $request->input('type', Content::TYPE_CAR);
        $status = $request->input('status', Content::STATUS_PUBLISHED);
        $visibility = $request->input('visibility', Content::VISIBILITY_PUBLIC);

        $metaInputs = self::discernMetasFromRequest($request->input());
        $contents = Content::where('type', $type)
        ->where('status', $status)
        ->where('visibility', $visibility);

        if (isset($author_id)) {
            $contents = $contents->where('author_id', $author_id);
        } else if ($request->has('author_id')) {
            $author_id = self::requestOperator('author_id', $request, Null, Null);
            $contents = $contents->where($author_id['field'], $author_id['operator'], $author_id['value']);
        }

        if (count($metaInputs) > 0) {
            foreach ($metaInputs as $key => $value) {
                if ($value === "0" || $value === 0) {
                    $contents = $contents->whereDoesntHave('metas', function ($query) use ($key, $value, $request) {
                        $query->where('key', $key);
                        $query->where('value', "1");
                    });
                } else {
                    $contents = $contents->whereHas('metas', function ($query) use ($key, $value, $request) {
                        $meta = self::requestOperator($key, $request, Null, $value);
                        $query->where('key', $key);
    
                        if (\Str::endsWith($key, 'Amount')) {
                            if (is_array($meta)) {
                                foreach ($meta as $m) {
                                    $query->whereRaw('cast(value as unsigned) ' . $m['operator'] . ' ' . $m['value']);
                                }
                            } else {
                                $query->whereRaw('cast(value as unsigned) ' . $meta['operator'] . ' ' . $meta['value']);
                            }
                        } else {
                            $query->where('value', $meta['operator'], $meta['value']);
                        }
                    });
                }
            }
        }

        $termInputs = self::discernTermsFromRequest($request->input());
        if (count($termInputs) > 0) {
            foreach ($termInputs as $key => $value) {
                if (is_number($value)) {

                    $contents = $contents->whereHas('terms', function($q) use($value) {
                        $q->where('term_taxonomy_id', $value);
                    });
                }
            }
        }
        return $contents;
    }

    /**
     * Filter & Serialize mixed request of Content and ContentMetas to Content Object with ContentMeta subarray
     * @return Paginated Content
     */
    public static function serializeRequest(Request $request, $author_id = null)
    {
        $limit = self::requestOperator('limit', $request, 10);
        $sort = $request->input('sort', '-id');
        $contents = self::filterByRequest($request, $author_id);

        // Sort parameter
        if (\Str::startsWith($sort, '-')) {
            $sort = substr($sort, 1);
            $sortDir = 'desc';
        } else if (\Str::startsWith($sort, '+')) {
            $sort = substr($sort, 1);
            $sortDir = 'asc';
        } else {
            $sortDir = 'asc';
        }
        $contents = $contents->orderBy($sort, $sortDir);

        $contents = $contents->paginate($limit['value']);
        return $contents;
    }

    /**
     * Used to discern content metas from attributes of Content Model.
     * @return array of ContentMeta, consisting of key, value pairs
     */
    public static function discernMetasFromRequest($input)
    {
        $inputExcept = ['title', 'slug', 'content', 'type', 'status', 'visibility', 'limit', 'page', 'author_id', '_token', '_method', 'sort'];
        $termExcept = self::TERM_KEYS;
        //$inputExcept = array_merge($inputExcept, $termExcept);
        $metaInputs = array_filter($input, function ($key) use ($inputExcept) {
            return !in_array($key, $inputExcept);
        }, ARRAY_FILTER_USE_KEY);
        return $metaInputs;
    }

    /**
     * Used to discern terms from attributes of Content Model.
     * @return array of ContentMeta, consisting of key, value pairs
     */
    public static function discernTermsFromRequest($input)
    {
        $termIn = self::TERM_KEYS;
        $metaInputs = array_filter($input, function ($key) use ($termIn) {
            return in_array($key, $termIn);
        }, ARRAY_FILTER_USE_KEY);
        return $metaInputs;
    }

    // String Enumeration
    // sw - Starts With
    // ew - Ends With
    // nc - Not Contains Keyword
    // co - Contains keyword

    // Operators
    // eq - = (Default)
    // ne - !=
    // gt - >
    // ge - >=
    // lt - <
    // le - <=

    // Example
    // /api/v1/contents?type=car&price[ge]=1000
    public static function requestOperator($inputName, $request, $defaultValue = null)
    {
        $op = $request->input($inputName, $defaultValue);
        if (is_array($op)) {
            $opArray = array();
            foreach ($op as $key => $value) {
                array_push($opArray, self::operator($inputName, self::operatorSymbol($key), self::operatorValue($key, $value)));
            }
            return $opArray;
        } else {
            $op = self::operator($inputName, self::operatorSymbol('eq'), self::operatorValue('eq', $op));
        }

        return $op;
    }

    public static function operator($field, $operator, $value)
    {
        return [
            'field' => $field,
            'operator' => $operator,
            'value' => $value
        ];
    }

    public static function operators() {
        return [
            'sw' => self::operatorSymbol('sw'),
            'ew' => self::operatorSymbol('ew'),
            'nc' => self::operatorSymbol('nc'),
            'co' => self::operatorSymbol('co'),

            'eq' => self::operatorSymbol('eq'),
            'ne' => self::operatorSymbol('ne'),
            'gt' => self::operatorSymbol('gt'),
            'ge' => self::operatorSymbol('ge'),
            'lt' => self::operatorSymbol('lt'),
            'le' => self::operatorSymbol('le'),
            'id' => self::operatorSymbol('id')
        ];
    }

    public static function operatorSymbol($name) {
        switch ($name) {
            case 'sw': return 'LIKE';
            case 'ew': return 'LIKE';
            case 'nc': return 'NOT LIKE';
            case 'co': return 'LIKE';

            case 'eq': return '=';
            case 'ne': return '!=';
            case 'gt': return '>';
            case 'ge': return '>=';
            case 'lt': return '<';
            case 'le': return '<=';
            case 'id': return '=';
            default: return '==';
        }
    }

    public static function operatorValue($operator, $value) {
        switch ($operator) {
            case 'sw': return $value.'%';
            case 'ew': return '%'.$value;
            case 'nc': return '%'.$value.'%';
            case 'co': return '%'.$value.'%';

            case 'eq': return $value;
            case 'ne': return $value;
            case 'gt': return $value;
            case 'ge': return $value;
            case 'lt': return $value;
            case 'le': return $value;
            case 'id': return TaxonomyManager::getValue($value);
            default: return $value;
        }
    }

    /**
     * Transform Content to json-ready array
     * Can take additional parameters to merge
     * @return content array
     */
    public static function contentToArray(Content $content, $additional = null)
    {
        $result = new ContentResource($content);
        if ($additional) {
            $result = array_merge($result->toArray(request()), $additional);
        }
        return $result;
    }

    public static function publish($request, $contentId, $publishAmount, $publishUnit, $publishDuration) {
        try {
            DB::beginTransaction();

            $content = Content::findOrFail($contentId);
            $content->status = $request->input('status', Content::STATUS_PUBLISHED);
            $content->visibility = $request->input('visibility', Content::VISIBILITY_PUBLIC);
            $content->updateMeta('publishedAt', Carbon::now());
            
            // Attach default Term id
            $notVerified = Term::where('slug', 'batalgaazhaagy')->first();
            $content->terms()->attach($notVerified);
            $author = $content->author()->first();
            $sellerTerm = Term::where('slug', 'khuv-khn')->first();
            if ($author->get_dealer_group()) {
                $sellerTerm = Term::where('slug', 'borluulagch')->first();
            }
            $content->terms()->attach($sellerTerm);

            if ($request->has('publishType')) {
                $publishType = $request->input('publishType');
            } else {
                $publishType = $content->metaValue('publishType');
            }

            if ($publishType == 'best_premium' || $publishType == 'premium') {
                $content->setMetaValue('publishAmount', $publishAmount);
                $content->setMetaValue('publishUnit', $publishUnit);
                $content->setMetaValue('publishDuration', $publishDuration);

                $result = self::publishPremium($content);
                if ($result) {
                    // continue;
                } else {
                    $content->order = 1;
                    $content->save();
                    DB::commit();
                    return 0;
                }
            } elseif($publishType == 'free') {
                $content->order = 1;
            }

            $content->save();
            DB::commit();
            return 1;
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            DB::rollBack();
            // return 0;
        }
    }

    public static function publishPremium($content) {
        $content->order = 1;
        $publishType = $content->metaValue('publishType');
        if ($publishType == 'best_premium' || $publishType == 'premium') {
            $author = $content->author;
            $cash = $author->metaValue('cash');
            $amount = $content->metaValue('publishAmount');
            if ($cash - $amount <= 0) {
                return false;
            }
            $cash = $cash - $amount;
            $author->setMetaValue('cash', $cash);
            Transaction::create([
                'user_id' => $author->id, 
                'payment_method' => 1, 
                'transaction_type' => 'outcome', 
                'transaction_amount' => $amount, 
                'transaction_usage' => $publishType, 
                'status' => Transaction::STATUS_ACCEPTED, 
                'content_id' => $content->id
            ]);

            $content->status = Content::STATUS_PUBLISHED;
            $content->visibility = Content::VISIBILITY_PUBLIC;
            if ($publishType == 'best_premium') {
                $content->order = 3;
            } else if ($publishType == 'premium') {
                $content->order = 2;
            }
            $content->updateMeta('publishedAt', Carbon::now());

            $content->save();
            return true;
        }
        return true;
    }
}
