<?php

namespace Modules\Car\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CarOptionsGutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guts = ['Power Door lock', 'Memory seat : driver’s seat', 'Heated Seat: Rear Seat', 'Heated Seat: Driver’s Seat', 'Electric seat : Passenger seat', 'Electric seat : driver’s seat'
        , 'Leather seat', 'Power steering', 'Steering wheel remote control'];

        $parent = TaxonomyManager::findTaxonomy('car-options');

        foreach ($guts as $key => $gut) {
            TaxonomyManager::register($gut, 'car-guts', $parent->term->id);
        }

        TaxonomyManager::updateTaxonomyChildrenSlugs($parent->id);
    }
}
