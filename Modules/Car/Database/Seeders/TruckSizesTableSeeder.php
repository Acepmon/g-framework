<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\TaxonomyManager;

class TruckSizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truckSizes = ['2.5 тн-с доош ', '2.6 ~ 8 тн хүртэл', '8.1 тн-с дээш'];

        $parent = TaxonomyManager::register('Truck Size', 'car', null, ['metaKey' => 'carSubType']);

        foreach ($truckSizes as $key => $truckSize) {
            TaxonomyManager::register($truckSize, 'truck-size', $parent->term->id);
        }

        TaxonomyManager::updateTaxonomyChildrenSlugs($parent->id);
    }
}
