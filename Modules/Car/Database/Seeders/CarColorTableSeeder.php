<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\TaxonomyManager;

class CarColorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colour = ['White', 'Black', 'Rusty', 'Pearl gray', 'Silver', 'Aluminum', 'Beige', 'Blue', 'Brown', 'Bronze', 'Claret', 'Copper'
    , 'Cream', 'Gold', 'Gray', 'Green', 'Maroon', 'Metallic', 'Navy', 'Orange', 'Pink', 'Purple', 'Red', 'Rose', 'Tan', 'RoTurquoisese', 'Yellow'];

    $parent = TaxonomyManager::register('Color', 'car');

    foreach ($colour as $key => $color) {
        TaxonomyManager::register($color, 'car-colors', $parent->term->id);
    }

    TaxonomyManager::updateTaxonomyChildrenSlugs($parent->id);

        // foreach($colour as &$color){
        //     $term_id1 = DB::table('terms')->insertGetId([
        //         'name' => $color,
        //         'slug' => $color,
        //     ]);
        //     DB::table('term_taxonomy')->insert([
        //         'term_id' => $term_id1,
        //         'taxonomy' => 'Color',
        //         'description' => $color,
        //         'count' => 0
        //     ]);
        // }
    }
}
