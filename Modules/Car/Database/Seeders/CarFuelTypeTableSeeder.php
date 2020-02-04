<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\TaxonomyManager;

class CarFuelTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fuelType = ['Бензин', 'Цахилгаан', 'Дизель', 'Hybrid', 'Газ'];

        $parent = TaxonomyManager::register('Car Fuel', 'car', null, ['metaKey' => 'fuelType']);

        foreach ($fuelType as $key => $fuel) {
            TaxonomyManager::register($fuel, 'car-fuel', $parent->term->id);
        }

        TaxonomyManager::updateTaxonomyChildrenSlugs($parent->id);
    }
}
