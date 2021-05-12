<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Entities\TaxonomyManager;

class CarWheelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wheels = ['Урд', 'Хойд', '4WD'];

        $parent = TaxonomyManager::register('Wheel', 'car', null, ['metaKey' => 'wheelDrive']);

        foreach ($wheels as $key => $wheel) {
            TaxonomyManager::register($wheel, 'car-wheel', $parent->term->id);
        }

        TaxonomyManager::updateTaxonomyChildrenSlugs($parent->id);

    }
}
