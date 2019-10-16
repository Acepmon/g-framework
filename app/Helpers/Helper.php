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
    $value /= 1000000;
    return $value . ' сая';
}

function getMetasValue($metas, $key) {
    foreach($metas as $meta){
        if($meta->key==$key){
            return $meta->value;
        }
    }
}

function isPremium($car) {
    return
        $car->type == App\Content::TYPE_CAR &&
        $car->status == App\Content::STATUS_PUBLISHED &&
        $car->visibility == App\Content::VISIBILITY_PUBLIC &&
        $car->metaValue('publishVerified') == True &&
        $car->metaValue('publishVerifiedEnd') >= now() &&
        ($car->metaValue('publishType') == 'best_premium' || $car->metaValue('publishType') == 'premium');
}

function metaHas($items, $key, $value) {
    return $items->whereHas('metas', function ($query) use ($key, $value) {
        $query->where('key', $key)->where('value', $value);
    });
}

function format_phone($phone) {
    $phone = trim($phone);
    $phone = str_replace(' ', '', $phone);
    $phone = str_replace('+', '', $phone);

    // add logic to correctly format number here
    // a more robust ways would be to use a regular expression
    return "(".substr($phone, 0, 3).") ".substr($phone, 3, 4)." ".substr($phone, 7);
}
