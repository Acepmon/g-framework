<?php

function system_asset(string $string)
{
    $name = $string;
    if (substr($string, 0, 1) == '/' || substr($string, 0, 1) == '\\') {
        $name = DIRECTORY_SEPARATOR . substr($string, 1);
    } else {
        $name = DIRECTORY_SEPARATOR . $string;
    }
    $path = 'system' . $name;
    return asset($path);
}

function get_string_between($string, $start, $end)
{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function put_string_between($string, $start, $end, $replacement)
{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;

    $part1 = substr($string, 0, $ini);
    $part2 = substr($string, $len);
    return $part1 . $replacement . $part2;
}

function get_blade_section(string $path, string $section)
{
    $contents = file_get_contents($path);
    $sectionNameStart = "@section('".$section."')";
    $sectionNameEnd = "@endsection";

    return get_string_between($contents, $sectionNameStart, $sectionNameEnd);
}

function put_blade_section(string $path, string $section, $replacement)
{
    $contents = file_get_contents($path);
    $sectionNameStart = "@section('".$section."')";
    $sectionNameEnd = "@endsection";

    return put_string_between($contents, $sectionNameStart, $sectionNameEnd, '\\n' . $replacement . '\\n');
}

function numerizePrice($value) {
    $value = floatval($value);
    if ($value < 1000) {
        return round($value, 2);
    } else if ($value < 1000000) {
        return number_format(round(($value / 1000), 0)) . ' мянга';
    } else {
        $remainder = rtrim(round(($value % 1000000) / 10000), "0");
        $remainder = ($remainder)?'.'.$remainder:'';
        return number_format(floor($value / 1000000)) . $remainder . ' сая';
    }
}

function getDateFromDatetime($value) {
    if ($value) {
        $value = new DateTime($value);
        return $value->format('Y-m-d');
    }
    return $value;
}

function getMetasValue($metas, $key) {
    foreach($metas as $meta){
        if($meta->key==$key){
            if (\Str::endsWith($key, 'Amount')) {
                if (is_numeric($meta->value)) {
                    return $meta->value;                    
                } else {
                    return '0';
                }
            }
            return $meta->value;
        }
    }
}

function isPremium($car) {
    if ($car->type == App\Content::TYPE_CAR &&
    $car->status == App\Content::STATUS_PUBLISHED &&
    $car->visibility == App\Content::VISIBILITY_PUBLIC &&
    // $car->metaValue('publishVerifiedEnd') >= now() &&
    $car->metaValue('publishVerified') == True) {
        /*$publishType = $car->metaValue('publishType');
        if ($publishType == 'best_premium' || $publishType == 'premium') {
            return $publishType;
        }*/
        if ($car->order == "1") {
            return "free";
        } else if ($car->order == "2") {
            return "premium";
        } else if ($car->order == "3") {
            return "best_premium";
        }
    }
    return false;
}

function metaHas($items, $key, $value, $operator = '=', $min = Null, $max = Null) {
    if ($operator == 'doesntHave') {
        return $items->whereDoesntHave('metas', function($query) use($key) {
            $query->where('key', $key);
            $query->where('value', '1');
        });
    }
    return $items->whereHas('metas', function ($query) use ($key, $value, $operator, $min, $max) {
        $query->where('key', $key);
        if ($operator == 'in') {
            $query->whereIn('value', explode('|', $value));
        } else if ($operator == 'not in') {
            $query->whereNotIn('value', explode('|', $value));
        } else if ($operator == 'range'){
            if ($min != Null) {
                $query->whereRAW('cast(value as unsigned) >= ' .$min);
            }
            if ($max != Null) {
                $query->whereRAW('cast(value as unsigned) <= ' .$max);
            }
        } else if (is_array($value)){
            $query->whereIn('value', $value);
        } else {
            $query->where('value', $operator, $value);
        }
    });
}

function getTaxonomyCount($taxonomy, $items, $request) {
    $count = $taxonomy->count;
    if ($taxonomy->term->group) {
        $count = metaHas(\Modules\Car\Entities\Car::filter(clone $items, $request, $taxonomy->term->group->metaValue('metaKey')), $taxonomy->term->group->metaValue('metaKey'), $taxonomy->term->name)->count();
    }
    return $count;
}

function countModel($items) {
    $items->join('content_metas', function($join) {
        $join->on('contents.id', '=', 'content_metas.content_id');
        $join->where('content_metas.key', '=', 'modelName');
    });
    $items = $items->select('contents.*', 'content_metas.value');
    $items = $items->groupBy('value');
    dd($items->get());

}

function format_phone($phone) {
    $phone = trim($phone);
    $phone = str_replace(' ', '', $phone);
    $phone = str_replace('+', '', $phone);

    // add logic to correctly format number here
    // a more robust ways would be to use a regular expression
    return "(".substr($phone, 0, 3).") ".substr($phone, 3, 4)." ".substr($phone, 7);
}
