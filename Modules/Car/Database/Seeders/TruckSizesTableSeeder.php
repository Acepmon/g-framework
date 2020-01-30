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
        $truckSizes = ['Small-size Truck:Less than 2.5 ton(2,500kg)', 'Mid-size Truck:2.5 ton(2,500kg) ~ Less than 8 ton(8,000kg)', 'Big-size Truck:8 ton(8,000kg) and more'];

        $parent = TaxonomyManager::register('Truck Size', 'car', null, ['metaKey' => 'carSubType']);

        foreach ($truckSizes as $key => $truckSize) {
            TaxonomyManager::register($truckSize, 'truck-size', $parent->term->id);
        }

        TaxonomyManager::updateTaxonomyChildrenSlugs($parent->id);
    }
}
