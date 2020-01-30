<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\TaxonomyManager;

class BusSizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $busSizes = ['Small-size Bus:Less than 20 people', 'Mid-size Bus:20 people ~ Less than 40 people', 'Big-size Bus:40 people and more'];

        $parent = TaxonomyManager::register('Bus Sizes', 'car', null, ['metaKey' => 'carSubType']);

        foreach ($busSizes as $key => $busSizes) {
            TaxonomyManager::register($busSizes, 'bus-sizes', $parent->term->id);
        }

        TaxonomyManager::updateTaxonomyChildrenSlugs($parent->id);
    }
}
