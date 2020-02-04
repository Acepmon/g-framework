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
        $busSizes = ['20-с доош', '21-40 хүртэл', '40-с дээш'];

        $parent = TaxonomyManager::register('Bus Sizes', 'car', null, ['metaKey' => 'carSubType']);

        foreach ($busSizes as $key => $busSizes) {
            TaxonomyManager::register($busSizes, 'bus-sizes', $parent->term->id);
        }

        TaxonomyManager::updateTaxonomyChildrenSlugs($parent->id);
    }
}
